import pymysql
import sys
import os
import xlwt
import json

class neo_mysql:
    def __init__(self):
        self.db_host = '127.0.0.1'
        self.db_user = 'root'
        self.db_passwd = 'root'
        self.database = 'ceping'
    
    # 查询sql
    # 参数含义
    # sql: 查询的sql语句
    # row: 取查询结果的第几行数据
    # col: 取行的第几列数据
    def query_mysql(self, sql, row=None, col=None):
        conn = pymysql.connect(host = self.db_host, user = self.db_user, passwd = self.db_passwd, database=self.database)
        cur = conn.cursor()
        cur.execute(sql)
        data = cur.fetchall()
        cur.close()
        conn.close()
        # 查询到有数据则进入行判断，row有值且值有效则取指定行数据，无值则默认第一行
        if data != None and len(data) > 0:
            if row != None:
                if row >= 0 and row < len(data):
                    value = data[row]
                    # info = '查询第' + str(row) + '行数据'
                    # print(info)
                else:
                    value = None
                    # print("行取值超出范围！")
                    return None
            else:
                value = data
        else:
            value = None
            # print("未查询到数据！")
            return None
        # 列判断，col有值且值有效则取指定列数据，无值则默认第一列
        if col != None:
            if col >= 0 and col < len(value):
                value = str(value[col])
                # info = '查询第' + str(col) + '列数据'
                # print(info)
            else:
                value = None
                # print("列取值超出范围！")
                return None
            
        return value
    
#程序入口
if __name__ == "__main__":

    #建立mysql链接
    my_test = neo_mysql()
    sql = 'SELECT cp_s.name AS school_name, cp_e.name AS examination_name,cp_u.name AS student_name, cp_er.type as type, cp_e.id as examination_id, cp_er.result as examResult,cp_er.id as id FROM cp_examination_results cp_er JOIN users cp_u ON cp_er.user_id = cp_u.id JOIN cp_examination cp_e ON cp_er.examination_id = cp_e.id JOIN cp_school cp_s ON cp_er.school_id = cp_s.id WHERE cp_s.id = 11'

    result = my_test.query_mysql(sql)
    
    workbook = xlwt.Workbook()

    for row in result:

        sheet = workbook.add_sheet(row[2])

        data = json.loads(row[5], strict=True)
        for i, row in enumerate(data): 
            modularSql = 'SELECT name FROM cp_modular WHERE id = '+row['modular_id']
            modular = my_test.query_mysql(modularSql, row=0, col=0)

            questionSql = 'SELECT question FROM cp_question WHERE id = '+row['question_id']
            question = my_test.query_mysql(questionSql, row=0, col=0)
            
            sheet.write(i, 0, modular)
            sheet.write(i, 1, question)
            sheet.write(i, 2, row['title'])

    workbook.save('./export.xlsx')
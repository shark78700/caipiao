#!/usr/bin/python
# -*- coding: UTF-8 -*-
import MySQLdb
class MyPdo:

    __myaddress='';__username='';__passwd='';__database='';__wherelist=[];__db=None;__source=None
    __myfield='';__mytable='';__myorder=[];__mylimit=''; __search='';
    """私有属性"""
#*****************************************************************************************************
    def __init__(self,myaddress,username,passwd,database):
        self.__myaddress=myaddress
        self.__username=username
        self.__passwd=passwd
        self.__database=database
        try:
            self.__db = MySQLdb.connect(self.__myaddress,self.__username,self.__passwd,self.__database)
            self.__source = self.__db.cursor()
        except:
            print "请检查数据库连接参数"



#"""构造函数"""
#*****************************************************************************************************
    def where(self,mylist):
        if isinstance(mylist,list):
            for i in mylist:
                if not 1<len(i)<=4:
                    return "输入数据错误"


            self.__wherelist = mylist

#"""where方法"""
#***************************************************************************************************
    def table(self,mytable):
        if isinstance(mytable,str):
            self.__mytable=mytable
        else:
            return "数据表名字输入错误"

#"""table方法"""
#**************************************************************************************************


    def field(self,myfield):
        if isinstance(myfield,list):
            self.__myfield=myfield
        else:
            return "字段内容必须是列表"

    # """fiedl方法"""
    # **************************************************************************************************
    def order(self,myorder):

        if isinstance(myorder,list) and len(myorder)==2:
            self.__myorder=myorder

        else:
            return "排序内容必须是列表"

    # """order方法"""
    # **************************************************************************************************
    def limit(self,num):

        if isinstance(num,int) and num >0:
            self.__mylimit=self.__mylimit+str(num)
        else:
            return 'limit 内容必须是正整数'

    # """limit方法"""
    # **************************************************************************************************
    def select(self):
        if self.__source:
            self.__search="select "

            if self.__myfield:
                if len(self.__myfield)==False:
                    self.__search = self.__search + self.__myfield[0]
                else:
                    for i in xrange(len(self.__myfield)):
                        if i==0:
                            self.__search=self.__search+self.__myfield[i]
                        else:
                            self.__search=self.__search+','+self.__myfield[i]



            else:
                self.__search=self.__search+" *  "


            if self.__mytable:
                self.__search=self.__search+' from '+ self.__mytable+' '
            else:
                return "数据表名不能为空"

            if len(self.__wherelist)>0:

                self.__search=self.__search+" where "
                wherelen=len(self.__wherelist)
                if wherelen==1:
                    if len(self.__wherelist[0])==2:
                        self.__search=self.__search+' '+self.__wherelist[0][0]+'='+self.__wherelist[0][1]
                    elif len(self.__wherelist[0])==3:
                        self.__search = self.__search+' ' + self.__wherelist[0][0] + self.__wherelist[0][2] + self.__wherelist[0][1]
                    else:
                        return "where 数据错误"

                else:
                    for i in xrange(len(self.__wherelist)):
                        if i==len(i)-1:
                            if len(i)==2:
                                self.__search=self.__search+' '+i[0]+'='+i[1]
                            elif len(i)==3:
                                self.__search=self.__search+' '+i[0]+i[3]+i[1]
                            else:
                                return "where 数据错误"
                        else:
                            if len(i)==2:
                                self.__search=self.__search+' '+i[0]+'='+i[1]+" and "
                            elif len(i)==3:
                                self.__search=self.__search+' '+i[0]+i[3]+i[1]+" and "
                            else:
                                self.__search=self.__search+' '+i[0]+i[3]+i[1]+' '+i[4]+' '


            if self.__myorder:
                self.__search=self.__search+" group by "+self.__myorder[0]+' '+self.__myorder[1]

            if self.__mylimit:
                self.__search=self.__search+" limit "+self.__mylimit

            #return self.__search
           # exit()

            if self.__search or self.__source:


                self.__source.execute(self.__search)

                return self.__source.fetchall()
                self.__db.close()
            else:
                return False

# """select方法"""
# **************************************************************************************************
    def mystr(self,mystr):
        if isinstance(mystr,str):

            try:
                self.__source.execute(mystr)
                self.__db.commit()
                return True
                self.__db.close()
            except:
                return False













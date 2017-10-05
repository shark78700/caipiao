#!/usr/bin/python
# -*- coding: UTF-8 -*-


import Source,Source1,json,datetime
from random import *

def quzidian(mylist,leibie):
    myzidian={}
    for i in xrange(len(mylist)):
        exec "myzidian[str(i+1)]="+leibie+"(mylist[i]) if not isinstance(mylist[i]," +leibie+") else mylist[i]"

    return myzidian

#******************************************************************************************************************
def quzhi(duoshao,zidian,daxiao):
    quredyi = {}
    for i in xrange(duoshao):
        exec "quredyi["+daxiao+"(zidian, key=zidian.get)]=zidian["+daxiao+"(zidian, key=zidian.get)];zidian.pop("+daxiao+"(zidian, key=zidian.get))"

    return quredyi

#********************************************************
#********************************************************
def baifen(mytup):
    if isinstance(mytup,tuple):
        myred=[]
        myblue=[]
        for i in xrange(35):
            if i<12:
                myred.append(0)
                myblue.append(0)
            else:
                myred.append(0)


        mysum = float(len(mytup))

        for i in mytup:
            x=i[0].split(',')
            xsum=len(x)
            for j in xrange(xsum):
                if j<=4:
                    myred[int(x[j])-1]+= 1

                else:
                    myblue[int(x[j])-1]+=1

        for i in xrange(35):
            if i<12:
                myblue[i]/=mysum
                myred[i]/=mysum
            else:
                myred[i]/=mysum


        return json.dumps([myred,myblue])

    """统计红球篮球出现概率的函数"""
#**********************************************************************
def middleNum(mylist):
    my=sorted(mylist)
    if len(my)%2==0:
        return float(my[int(len(my)/2)]+my[int(len(my)/2)+1])
    else:
        return float(my[int(len(my)/2)+1])

"""中位数函数"""
#********************************************************************

"""代码体"""
begin = datetime.datetime.now()
mydb = Source1.MyPdo('localhost','root','root','caipiao')
mydb.field(["allcode"])
mydb.table("bocai_letou")
mydb1=mydb.select()
bai = baifen(mydb1)
del mydb

"""取得所有中奖数据并将数据处理成一个所有号码百分比的j数据"""
#***************************************

mydb =Source1.MyPdo('localhost','root','root','caipiao')
mydb.field(["times"])
mydb.table("bocai_letou")
mydb.order(["times","desc"])
mydb.limit(1)
times=int(mydb.select()[0][0])
del mydb
"""取得开奖数据的最后一期期号"""
#************************************************

mydb=Source1.MyPdo('localhost','root','root','caipiao')
mydb.table("bocai_leyi")
mydb.where([["times",str(times)]])
yilou=mydb.select()

exec "redyi="+yilou[0][2]
exec "blueyi="+yilou[0][3]

redct={}
redsum=0
for i in xrange(len(redyi)):
    redct[i] = float(redyi[i])
    redsum += redct[i]

redzhong = middleNum(redyi)
"""红球遗漏中位数"""
maxred = max(redct)
"""红球遗漏最大值"""
minred = min(redct)
"""红球遗漏最小值"""
redcha = maxred - minred
"""红球遗漏最大差值"""
redpin = redsum / len(redyi)
"""红球遗漏平均值"""
redfang = float(0)
"""红球遗漏方差"""
for i in xrange(len(redct)):
    redfang = redfang + (redct[i] - redpin) ** 2

redfang = redfang / len(redct)

bluect={}
bluesum=0
for i in xrange(len(blueyi)):
    bluect[i]=float(blueyi[i])
    bluesum+=bluect[i]

bluezhong=middleNum(bluect)
"""蓝球遗漏平均值"""
maxblue=max(bluect)
"""蓝球遗漏最大值"""
minblue=min(bluect)
"""蓝球遗漏最小值"""
bluecha=maxblue-minblue
"""蓝球遗漏最大差值"""
bluepin=bluesum/len(bluect)
"""蓝球遗漏平均值"""
bluefang=float(0)
"""蓝球遗漏方差"""
for i in xrange(len(bluect)):
    bluefang=bluefang+(bluect[i]-bluepin)**2


mybai=json.loads(bai)
mybaired=mybai[0]
"""红球已出现概率list"""
mybaiblue=mybai[1]
"""蓝球已出现概率list"""
mybairedzhong=middleNum(mybaired)
"""红球已出现概率中位数"""
mybaibluezhong=middleNum(mybaiblue)
"""蓝球已出现概率中位数"""
mybairedmax=max(mybaired)
"""红球已出现概率最大值"""
mybairedmin=min(mybaired)
"""红球已出现概率最小值"""
mybairedcha=mybairedmax-mybairedmin
"""红球亦出现概率最大差值"""
mybaibluemax=max(mybaiblue)
"""蓝球已出现概率最大值"""
mybaibluemin=min(mybaiblue)
"""蓝球已出现概率最小值"""
mybaibluecha=mybaibluemax-mybaibluemin
"""蓝球已出现概率最大差值"""
mybairedsum=0.0
"""红球已出现概率总和"""
mybaibluesum=0.0
"""蓝球已出现概率总和"""
mybairedfang=0.0
"""红球已出现概率方差"""
mybaibluefang=0.0
"""蓝球已出现概率方差"""
for i in mybaired:
    mybairedsum+=i

mybairedpin=mybairedsum/len(mybaired)
"""红球已出现概率平均值"""

for i in mybaiblue:
    mybaibluesum+=i

mybaibluepin=mybaibluesum/len(mybaiblue)
"""蓝球已出现概率平均值"""


for i in mybaired:
    mybairedfang=mybairedfang+(i-mybairedpin)**2

mybairedfang/=len(mybaired)

for i in mybaiblue:
    mybaibluefang=mybaibluefang+(i-mybaibluepin)**2

mybaibluefang/=len(mybaiblue)

mybairedct={}
for i in xrange(len(mybaired)) :
    mybairedct[i]=mybaired[i]

mybaibluect={}
for i in xrange(len(mybaiblue)):
    mybaibluect[i]=mybaiblue[i]


#******************************************************************************
shujv={}
shujv["red"]={}
shujv["red"]["max"]=maxred
shujv["red"]["min"]=minred
shujv["red"]["pin"]=redpin
shujv["red"]["zhong"]=redzhong
shujv["red"]["fang"]=redfang
shujv["red"]["yi"]=redyi
shujv["red"]["cha"]=redcha
shujv["red"]["bai"]=mybaired
shujv["red"]["baizhong"]=mybairedzhong
shujv["red"]["baipin"]=mybairedpin
shujv["red"]["baifang"]=mybairedfang
shujv["red"]["baimax"]=mybairedmax
shujv["red"]["baimin"]=mybairedmin
shujv["red"]["baicha"]=mybairedcha
shujv["blue"]={}
shujv["blue"]["max"]=maxblue
shujv["blue"]["min"]=minblue
shujv["blue"]["pin"]=bluepin
shujv["blue"]["zhong"]=bluezhong
shujv["blue"]["fang"]=bluefang
shujv["blue"]["yi"]=blueyi
shujv["blue"]["cha"]=bluecha
shujv["blue"]["bai"]=mybaiblue
shujv["blue"]["baizhong"]=mybaibluezhong
shujv["blue"]["baipin"]=mybaibluepin
shujv["blue"]["baifang"]=mybaibluefang
shujv["blue"]["baimax"]=mybaibluemax
shujv["blue"]["baimin"]=mybaibluemin
shujv["blue"]["baicha"]=mybaibluecha
allshujv=json.dumps(shujv)


lishiqured=quzidian(redyi,"int")
lishiqublue=quzidian(blueyi,"int")
lishiquredlv=quzidian(mybaired,"float")
lishiqubluelv=quzidian(mybaiblue,"float")

quredyi=quzhi(16,lishiqured,"max")
qublueyi=quzhi(6,lishiqublue,"max")
quredlv=quzhi(8,lishiquredlv,"min")
qubluelv=quzhi(6,lishiqubluelv,"min")

bluejiao=[]
for i in qublueyi.items():
    for j in qubluelv.items():
        if i[0]==j[0]:
            bluejiao.append(i[0])



while len(bluejiao)>2:
    bluejiao.pop(randint(0,len(bluejiao)-1))

qubluelist=[]
for i in qubluelv.items():
    qubluelist.append(i[0])

while len(bluejiao)<3:
    x=choice(qubluelist)
    if x in bluejiao:
        pass
    else:
        bluejiao.append(x)

redjiao=[]
for i in quredyi.items():
    for j in quredlv.items():
        if i[0]==j[0]:
            redjiao.append(i[0])


quredlist=[]
for i in quredlv.items():
    quredlist.append(i[0])

while len(redjiao)<5:
    x=choice(quredlist)
    if x in redjiao:
        pass
    else:
        redjiao.append(x)

my30=0
my1=0
needdel=[]
for i in xrange(len(redjiao)):
        if int(redjiao[i])<=3 or int(redjiao[i])>=33:
            if int(redjiao[i])<=3:
                if my1==0:
                    my1+=1
                else:
                    needdel.append(redjiao[i])
            else:
                if my30==0:
                    my30+=1
                else:
                    needdel.append(redjiao[i])


if not len(needdel)==0:
    for i in needdel:
        redjiao.remove(i)

    while len(redjiao)<5:
        x=choice(quredlist)
        if x in redjiao:
            pass
        else:
            redjiao.append(x)

mydb = Source1.MyPdo('localhost','root','root','caipiao')
mydb.where([["times",str(times)]])
mydb.order(["times","desc"])
mydb.table('bocai_letoubai')
mydb.limit(1)
isbai=mydb.select()
if len(isbai)==0:
    del mydb
    mydb = Source1.MyPdo('localhost','root','root','caipiao')
    sql="insert into bocai_letoubai VALUES (0,"+str(times)+",'"+allshujv+"')"
    if mydb.mystr(sql):
        pass
    del mydb

print redjiao+bluejiao

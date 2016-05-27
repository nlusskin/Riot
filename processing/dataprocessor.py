# To change this license header, choose License Headers in Project Properties.
# To change this template file, choose Tools | Templates
# and open the template in the editor.
from azure.storage import BlobService
from datetime import datetime
__author__ = "Nicholas Lusskin"
__date__ = "$Mar 6, 2015 9:19:13 PM$"


timestamp = datetime.now()
input = "testdevice2"
print (timestamp, input)
blob_service = BlobService(account_name="ithings", account_key="vV3VaFbTw7KvnHNdsO8n4PeeRswDwN8lRA1jhBjVAGPQY9bXE1QgLkvQy9chINAQ7CeXxobzzM1dE7p6vX8tEQ==")

data = blob_service.get_blob_to_text('devices', input+'.txt')

tIndex = ['TimeStamp: ','DeviceID: ', 'Status: ', 'DataType: ', 'ColumnValue; ', 'RowValue: ']

for i in range(data.find(tIndex[1])):
    n = i
    DeviceTime = data[n]
    print (DeviceTime)


#print (data)
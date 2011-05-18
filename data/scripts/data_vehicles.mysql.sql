INSERT INTO ve_vehicles (`veId`, `plateNo`, `name`, `color`, `license`, `contactId`, `pilot`, `user`, `fuelCons`, `pDate`, `brand`, `price`, `remark`) VALUES('1', '川AB13K3', '奥迪R8', '黑', '1093847701938740', '1', '7', '总经理座驾', '20', '20100801', '奥迪', '2328000', '备注1');
INSERT INTO ve_vehicles (`veId`, `plateNo`, `name`, `color`, `license`, `contactId`, `pilot`, `user`, `fuelCons`, `pDate`, `brand`, `price`, `remark`) VALUES('2', '川AC0903', '路虎揽胜', '黑', '1498701592387100', '2', '8', '管理层', '14.9', '20101112', '路虎', '1850000', '备注2');
INSERT INTO ve_vehicles (`veId`, `plateNo`, `name`, `color`, `license`, `contactId`, `pilot`, `user`, `fuelCons`, `pDate`, `brand`, `price`, `remark`) VALUES('3', '川A0K412', '丰田卡罗拉', '银', '1094570199238102', '3', '8', '工程人员', '7.5', '20090314', '丰田', '199800', '备注3');
INSERT INTO ve_vehicles (`veId`, `plateNo`, `name`, `color`, `license`, `contactId`, `pilot`, `user`, `fuelCons`, `pDate`, `brand`, `price`, `remark`) VALUES('4', '川AW871L', '东风小康V27', '白', '2937409271904575', '20', '9', '工人', '11', '20090504', '东风', '50800', '备注4');

INSERT INTO ve_insurances (`insId`, `veId`, `startDate`, `endDate`, `total`, `remark`) VALUES('1', '1', '20110311', '20120310', '2445.12', '机动车保险单');
INSERT INTO ve_insurances (`insId`, `veId`, `startDate`, `endDate`, `total`, `remark`) VALUES('2', '1', '20110311', '20120310', '420', '交强险');

INSERT INTO ve_ins_spec (`ispecId`, `insId`, `spec`, `detail`, `price`) VALUES('1', '1', '第三者责任保险（B)', '责任金额200000', '928.4');
INSERT INTO ve_ins_spec (`ispecId`, `insId`, `spec`, `detail`, `price`) VALUES('2', '1', '机动车损失保险（A)', '责任金额72100', '1091.79');
INSERT INTO ve_ins_spec (`ispecId`, `insId`, `spec`, `detail`, `price`) VALUES('3', '1', '车上人员责任险（司）（D1)', '责任金额10000/座*1座', '76.03');
INSERT INTO ve_ins_spec (`ispecId`, `insId`, `spec`, `detail`, `price`) VALUES('4', '1', '车上人员责任险（乘）（D1)', '责任金额10000/座*4座', '29.97');
INSERT INTO ve_ins_spec (`ispecId`, `insId`, `spec`, `detail`, `price`) VALUES('5', '1', '不计免赔率（M）覆盖B/A/D1', '0', '318.93');
INSERT INTO ve_ins_spec (`ispecId`, `insId`, `spec`, `detail`, `price`) VALUES('6', '2', '交通事故责任强制保险', '', '420');

INSERT INTO ve_drirecords (`recordId`, `veId`, `rYear`, `rMonth`, `mileEarly`, `mileEnd`, `mile`, `remark`) VALUES('1', '1', '2011', '3', '26880', '27527', '647', '3月行驶记录');
INSERT INTO ve_drirecords (`recordId`, `veId`, `rYear`, `rMonth`, `mileEarly`, `mileEnd`, `mile`, `remark`) VALUES('2', '1', '2011', '4', '27527', '29070', '1543', '4月行驶记录');

INSERT INTO ve_repairs (`repId`, `veId`, `rDate`, `reason`, `detail`, `contactId`, `spot`, `descr`, `amount`, `insFlag`, `indem`, `remark`) VALUES('1', '1', '20110419', '后杠刮损', '', '9', '武侯立交 ', '被追尾', '800', '1', '500', '已修好');

INSERT INTO ve_mtncs (`mtnId`, `veId`, `rDate`, `detail`, `contactId`, `mile`, `amount`, `remark`) VALUES('1', '1', '20110315', '定期保养', '7', '26980', '1000', '备注1');
INSERT INTO ve_mtncs (`mtnId`, `veId`, `rDate`, `detail`, `contactId`, `mile`, `amount`, `remark`) VALUES('2', '2', '20110401', '定期保养', '7', '29705', '1000', '备注2');

INSERT INTO ve_verecords (`recordId`, `veId`, `prjFlag`, `projectId`, `startDate`, `endDate`, `period`, `route`, `mileBf`, `mileAf`, `mile`, `purpose`, `contactId`, `user`, `mileRef`, `amount`, `remark`) VALUES('1', '1', '1', '1', '20110328', '20110329', '', '试车-红牌楼', '27138', '27171', '33', '', '5', '', '', '', '');
INSERT INTO ve_verecords (`recordId`, `veId`, `prjFlag`, `projectId`, `startDate`, `endDate`, `period`, `route`, `mileBf`, `mileAf`, `mile`, `purpose`, `contactId`, `user`, `mileRef`, `amount`, `remark`) VALUES('2', '1', '1', '1', '20110329', '20110330', '', '成都-卧龙', '27171', '27321', '150', '', '6', '', '', '', '');
INSERT INTO ve_verecords (`recordId`, `veId`, `prjFlag`, `projectId`, `startDate`, `endDate`, `period`, `route`, `mileBf`, `mileAf`, `mile`, `purpose`, `contactId`, `user`, `mileRef`, `amount`, `remark`) VALUES('3', '1', '0', '', '20110330', '20110331', '', '卧龙-耿达-卧龙', '27321', '27377', '56', '', '6', '', '27345', '200', '');
INSERT INTO ve_verecords (`recordId`, `veId`, `prjFlag`, `projectId`, `startDate`, `endDate`, `period`, `route`, `mileBf`, `mileAf`, `mile`, `purpose`, `contactId`, `user`, `mileRef`, `amount`, `remark`) VALUES('4', '1', '1', '2', '20110331', '20110401', '', '卧龙-成都', '27377', '27527', '150', '', '7', '', '', '', '');
INSERT INTO ve_verecords (`recordId`, `veId`, `prjFlag`, `projectId`, `startDate`, `endDate`, `period`, `route`, `mileBf`, `mileAf`, `mile`, `purpose`, `contactId`, `user`, `mileRef`, `amount`, `remark`) VALUES('5', '1', '1', '2', '20110401', '20110402', '', '成都-卧龙', '27527', '27722', '195', '', '6', '', '27633', '200', '');
INSERT INTO ve_verecords (`recordId`, `veId`, `prjFlag`, `projectId`, `startDate`, `endDate`, `period`, `route`, `mileBf`, `mileAf`, `mile`, `purpose`, `contactId`, `user`, `mileRef`, `amount`, `remark`) VALUES('6', '1', '0', '', '20110403', '20110403', '', '卧龙-耿达-卧龙', '27722', '27780', '58', '', '4', '', '', '', '');
INSERT INTO ve_verecords (`recordId`, `veId`, `prjFlag`, `projectId`, `startDate`, `endDate`, `period`, `route`, `mileBf`, `mileAf`, `mile`, `purpose`, `contactId`, `user`, `mileRef`, `amount`, `remark`) VALUES('7', '1', '1', '2', '20110403', '20110403', '', '卧龙-耿达-卧龙', '27780', '27828', '48', '', '6', '', '', '', '');
INSERT INTO ve_verecords (`recordId`, `veId`, `prjFlag`, `projectId`, `startDate`, `endDate`, `period`, `route`, `mileBf`, `mileAf`, `mile`, `purpose`, `contactId`, `user`, `mileRef`, `amount`, `remark`) VALUES('8', '1', '1', '2', '20110403', '20110403', '', '卧龙-映秀-卧龙', '27828', '27928', '100', '', '6', '', '27858', '300', '路上堵车');
INSERT INTO ve_verecords (`recordId`, `veId`, `prjFlag`, `projectId`, `startDate`, `endDate`, `period`, `route`, `mileBf`, `mileAf`, `mile`, `purpose`, `contactId`, `user`, `mileRef`, `amount`, `remark`) VALUES('9', '1', '1', '3', '20110403', '20110403', '', '卧龙-都江堰-卧龙', '27928', '28072', '144', '', '7', '', '', '', '');
INSERT INTO ve_verecords (`recordId`, `veId`, `prjFlag`, `projectId`, `startDate`, `endDate`, `period`, `route`, `mileBf`, `mileAf`, `mile`, `purpose`, `contactId`, `user`, `mileRef`, `amount`, `remark`) VALUES('10', '1', '0', '', '20110404', '2010405', '', '卧龙-耿达-卧龙', '28072', '28118', '46', '', '6', '', '', '', '');
INSERT INTO ve_verecords (`recordId`, `veId`, `prjFlag`, `projectId`, `startDate`, `endDate`, `period`, `route`, `mileBf`, `mileAf`, `mile`, `purpose`, `contactId`, `user`, `mileRef`, `amount`, `remark`) VALUES('11', '1', '1', '3', '20110405', '20110406', '', '卧龙-耿达-卧龙', '28118', '28164', '46', '', '4', '', '', '', '');
INSERT INTO ve_verecords (`recordId`, `veId`, `prjFlag`, `projectId`, `startDate`, `endDate`, `period`, `route`, `mileBf`, `mileAf`, `mile`, `purpose`, `contactId`, `user`, `mileRef`, `amount`, `remark`) VALUES('12', '1', '1', '3', '20110406', '20110407', '', '卧龙-耿达-卧龙', '28164', '28210', '46', '', '6', '', '28185', '300', '');


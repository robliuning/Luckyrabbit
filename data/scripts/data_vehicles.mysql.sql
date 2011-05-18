INSERT INTO ve_vehicles (`veId`, `plateNo`, `name`, `color`, `license`, `contactId`, `pilot`, `user`, `fuelCons`, `pDate`, `brand`, `price`, `remark`) VALUES('1', '��AB13K3', '�µ�R8', '��', '1093847701938740', '1', '7', '�ܾ�������', '20', '20100801', '�µ�', '2328000', '��ע1');
INSERT INTO ve_vehicles (`veId`, `plateNo`, `name`, `color`, `license`, `contactId`, `pilot`, `user`, `fuelCons`, `pDate`, `brand`, `price`, `remark`) VALUES('2', '��AC0903', '·����ʤ', '��', '1498701592387100', '2', '8', '�����', '14.9', '20101112', '·��', '1850000', '��ע2');
INSERT INTO ve_vehicles (`veId`, `plateNo`, `name`, `color`, `license`, `contactId`, `pilot`, `user`, `fuelCons`, `pDate`, `brand`, `price`, `remark`) VALUES('3', '��A0K412', '���￨����', '��', '1094570199238102', '3', '8', '������Ա', '7.5', '20090314', '����', '199800', '��ע3');
INSERT INTO ve_vehicles (`veId`, `plateNo`, `name`, `color`, `license`, `contactId`, `pilot`, `user`, `fuelCons`, `pDate`, `brand`, `price`, `remark`) VALUES('4', '��AW871L', '����С��V27', '��', '2937409271904575', '20', '9', '����', '11', '20090504', '����', '50800', '��ע4');

INSERT INTO ve_insurances (`insId`, `veId`, `startDate`, `endDate`, `total`, `remark`) VALUES('1', '1', '20110311', '20120310', '2445.12', '���������յ�');
INSERT INTO ve_insurances (`insId`, `veId`, `startDate`, `endDate`, `total`, `remark`) VALUES('2', '1', '20110311', '20120310', '420', '��ǿ��');

INSERT INTO ve_ins_spec (`ispecId`, `insId`, `spec`, `detail`, `price`) VALUES('1', '1', '���������α��գ�B)', '���ν��200000', '928.4');
INSERT INTO ve_ins_spec (`ispecId`, `insId`, `spec`, `detail`, `price`) VALUES('2', '1', '��������ʧ���գ�A)', '���ν��72100', '1091.79');
INSERT INTO ve_ins_spec (`ispecId`, `insId`, `spec`, `detail`, `price`) VALUES('3', '1', '������Ա�����գ�˾����D1)', '���ν��10000/��*1��', '76.03');
INSERT INTO ve_ins_spec (`ispecId`, `insId`, `spec`, `detail`, `price`) VALUES('4', '1', '������Ա�����գ��ˣ���D1)', '���ν��10000/��*4��', '29.97');
INSERT INTO ve_ins_spec (`ispecId`, `insId`, `spec`, `detail`, `price`) VALUES('5', '1', '���������ʣ�M������B/A/D1', '0', '318.93');
INSERT INTO ve_ins_spec (`ispecId`, `insId`, `spec`, `detail`, `price`) VALUES('6', '2', '��ͨ�¹�����ǿ�Ʊ���', '', '420');

INSERT INTO ve_drirecords (`recordId`, `veId`, `rYear`, `rMonth`, `mileEarly`, `mileEnd`, `mile`, `remark`) VALUES('1', '1', '2011', '3', '26880', '27527', '647', '3����ʻ��¼');
INSERT INTO ve_drirecords (`recordId`, `veId`, `rYear`, `rMonth`, `mileEarly`, `mileEnd`, `mile`, `remark`) VALUES('2', '1', '2011', '4', '27527', '29070', '1543', '4����ʻ��¼');

INSERT INTO ve_repairs (`repId`, `veId`, `rDate`, `reason`, `detail`, `contactId`, `spot`, `descr`, `amount`, `insFlag`, `indem`, `remark`) VALUES('1', '1', '20110419', '��ܹ���', '', '9', '������� ', '��׷β', '800', '1', '500', '���޺�');

INSERT INTO ve_mtncs (`mtnId`, `veId`, `rDate`, `detail`, `contactId`, `mile`, `amount`, `remark`) VALUES('1', '1', '20110315', '���ڱ���', '7', '26980', '1000', '��ע1');
INSERT INTO ve_mtncs (`mtnId`, `veId`, `rDate`, `detail`, `contactId`, `mile`, `amount`, `remark`) VALUES('2', '2', '20110401', '���ڱ���', '7', '29705', '1000', '��ע2');

INSERT INTO ve_verecords (`recordId`, `veId`, `prjFlag`, `projectId`, `startDate`, `endDate`, `period`, `route`, `mileBf`, `mileAf`, `mile`, `purpose`, `contactId`, `user`, `mileRef`, `amount`, `remark`) VALUES('1', '1', '1', '1', '20110328', '20110329', '', '�Գ�-����¥', '27138', '27171', '33', '', '5', '', '', '', '');
INSERT INTO ve_verecords (`recordId`, `veId`, `prjFlag`, `projectId`, `startDate`, `endDate`, `period`, `route`, `mileBf`, `mileAf`, `mile`, `purpose`, `contactId`, `user`, `mileRef`, `amount`, `remark`) VALUES('2', '1', '1', '1', '20110329', '20110330', '', '�ɶ�-����', '27171', '27321', '150', '', '6', '', '', '', '');
INSERT INTO ve_verecords (`recordId`, `veId`, `prjFlag`, `projectId`, `startDate`, `endDate`, `period`, `route`, `mileBf`, `mileAf`, `mile`, `purpose`, `contactId`, `user`, `mileRef`, `amount`, `remark`) VALUES('3', '1', '0', '', '20110330', '20110331', '', '����-����-����', '27321', '27377', '56', '', '6', '', '27345', '200', '');
INSERT INTO ve_verecords (`recordId`, `veId`, `prjFlag`, `projectId`, `startDate`, `endDate`, `period`, `route`, `mileBf`, `mileAf`, `mile`, `purpose`, `contactId`, `user`, `mileRef`, `amount`, `remark`) VALUES('4', '1', '1', '2', '20110331', '20110401', '', '����-�ɶ�', '27377', '27527', '150', '', '7', '', '', '', '');
INSERT INTO ve_verecords (`recordId`, `veId`, `prjFlag`, `projectId`, `startDate`, `endDate`, `period`, `route`, `mileBf`, `mileAf`, `mile`, `purpose`, `contactId`, `user`, `mileRef`, `amount`, `remark`) VALUES('5', '1', '1', '2', '20110401', '20110402', '', '�ɶ�-����', '27527', '27722', '195', '', '6', '', '27633', '200', '');
INSERT INTO ve_verecords (`recordId`, `veId`, `prjFlag`, `projectId`, `startDate`, `endDate`, `period`, `route`, `mileBf`, `mileAf`, `mile`, `purpose`, `contactId`, `user`, `mileRef`, `amount`, `remark`) VALUES('6', '1', '0', '', '20110403', '20110403', '', '����-����-����', '27722', '27780', '58', '', '4', '', '', '', '');
INSERT INTO ve_verecords (`recordId`, `veId`, `prjFlag`, `projectId`, `startDate`, `endDate`, `period`, `route`, `mileBf`, `mileAf`, `mile`, `purpose`, `contactId`, `user`, `mileRef`, `amount`, `remark`) VALUES('7', '1', '1', '2', '20110403', '20110403', '', '����-����-����', '27780', '27828', '48', '', '6', '', '', '', '');
INSERT INTO ve_verecords (`recordId`, `veId`, `prjFlag`, `projectId`, `startDate`, `endDate`, `period`, `route`, `mileBf`, `mileAf`, `mile`, `purpose`, `contactId`, `user`, `mileRef`, `amount`, `remark`) VALUES('8', '1', '1', '2', '20110403', '20110403', '', '����-ӳ��-����', '27828', '27928', '100', '', '6', '', '27858', '300', '·�϶³�');
INSERT INTO ve_verecords (`recordId`, `veId`, `prjFlag`, `projectId`, `startDate`, `endDate`, `period`, `route`, `mileBf`, `mileAf`, `mile`, `purpose`, `contactId`, `user`, `mileRef`, `amount`, `remark`) VALUES('9', '1', '1', '3', '20110403', '20110403', '', '����-������-����', '27928', '28072', '144', '', '7', '', '', '', '');
INSERT INTO ve_verecords (`recordId`, `veId`, `prjFlag`, `projectId`, `startDate`, `endDate`, `period`, `route`, `mileBf`, `mileAf`, `mile`, `purpose`, `contactId`, `user`, `mileRef`, `amount`, `remark`) VALUES('10', '1', '0', '', '20110404', '2010405', '', '����-����-����', '28072', '28118', '46', '', '6', '', '', '', '');
INSERT INTO ve_verecords (`recordId`, `veId`, `prjFlag`, `projectId`, `startDate`, `endDate`, `period`, `route`, `mileBf`, `mileAf`, `mile`, `purpose`, `contactId`, `user`, `mileRef`, `amount`, `remark`) VALUES('11', '1', '1', '3', '20110405', '20110406', '', '����-����-����', '28118', '28164', '46', '', '4', '', '', '', '');
INSERT INTO ve_verecords (`recordId`, `veId`, `prjFlag`, `projectId`, `startDate`, `endDate`, `period`, `route`, `mileBf`, `mileAf`, `mile`, `purpose`, `contactId`, `user`, `mileRef`, `amount`, `remark`) VALUES('12', '1', '1', '3', '20110406', '20110407', '', '����-����-����', '28164', '28210', '46', '', '6', '', '28185', '300', '');


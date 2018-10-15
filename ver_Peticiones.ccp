<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" wizardTheme="InLine" wizardThemeType="File" needGeneration="0" cachingEnabled="False" cachingDuration="1 minutes" isService="False">
	<Components>
		<Record id="123" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" debugMode="False" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="peticiones_estados_estadoSearch" wizardCaption="Buscar Peticiones, Estados, Estados Pagos, Pacientes, Procedencias " wizardTheme="Inline" wizardThemeType="File" wizardOrientation="Vertical" wizardFormMethod="post" returnPage="ver_Peticiones.ccp" PathID="peticiones_estados_estadoSearch">
			<Components>
				<TextBox id="125" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="s_peticion_id" wizardCaption="Peticion Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" visible="Yes" PathID="peticiones_estados_estadoSearchs_peticion_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="126" fieldSourceType="DBColumn" dataType="Date" html="False" editable="True" hasErrorCollection="True" name="s_fecha_ini" wizardCaption="Fecha" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" format="dd/mm/yyyy" DBFormat="yyyy-mm-dd HH:nn:ss" defaultValue="CurrentDate" visible="Yes" PathID="peticiones_estados_estadoSearchs_fecha_ini">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="171" fieldSourceType="DBColumn" dataType="Date" html="False" editable="True" hasErrorCollection="True" name="s_fecha_fin" wizardTheme="Inline" wizardThemeType="File" format="dd/mm/yyyy" defaultValue="CurrentDate" DBFormat="yyyy-mm-dd HH:nn:ss" visible="Yes" PathID="peticiones_estados_estadoSearchs_fecha_fin">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="178" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="s_nombres" wizardTheme="Inline" wizardThemeType="File" visible="Yes" PathID="peticiones_estados_estadoSearchs_nombres">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="179" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="s_apellidos" wizardTheme="Inline" wizardThemeType="File" visible="Yes" PathID="peticiones_estados_estadoSearchs_apellidos">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="205" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_rut" wizardTheme="Inline" wizardThemeType="File" PathID="peticiones_estados_estadoSearchs_rut">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="130" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="s_procedencia_id" wizardCaption="Procedencia Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" sourceType="Table" connection="Datos" dataSource="procedencias" boundColumn="procedencia_id" textColumn="nom_procedencia" activeCollection="TableParameters" activeTableType="dataSource" orderBy="nom_procedencia" visible="Yes" PathID="peticiones_estados_estadoSearchs_procedencia_id">
					<Components/>
					<Events/>
					<TableParameters>
						<TableParameter id="181" conditionType="Expression" useIsNull="False" searchConditionType="Equal" parameterType="URL" logicOperator="Or" expression="&quot;. GetCondicion('procedencia') .&quot;" orderNumber="2"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
					<PKFields/>
				</ListBox>
				<ListBox id="131" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="s_estado_id" wizardCaption="Estado Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" sourceType="Table" connection="Datos" dataSource="estados" boundColumn="estado_id" textColumn="nom_estado" activeCollection="TableParameters" activeTableType="dataSource" orderBy="estado_id" visible="Yes" PathID="peticiones_estados_estadoSearchs_estado_id">
					<Components/>
					<Events/>
					<TableParameters>
						<TableParameter id="200" conditionType="Parameter" useIsNull="False" field="usar_en" dataType="Text" searchConditionType="Equal" parameterType="Expression" logicOperator="And" defaultValue="'peticiones'" parameterSource="'peticiones'" orderNumber="1"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
					<PKFields/>
				</ListBox>
				<ListBox id="176" fieldSourceType="DBColumn" sourceType="Table" dataType="Integer" editable="True" hasErrorCollection="True" returnValueType="Number" name="s_estado_pago_id" wizardTheme="Inline" wizardThemeType="File" wizardEmptyCaption="Seleccionar Valor" connection="Datos" dataSource="estados_pagos" boundColumn="estado_pago_id" textColumn="nom_estado_pago" visible="Yes" PathID="peticiones_estados_estadoSearchs_estado_pago_id">
					<Components/>
					<Events/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
					<PKFields/>
				</ListBox>
				<Button id="124" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Buscar" PathID="peticiones_estados_estadoSearchButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
			</Components>
			<Events/>
			<TableParameters/>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<ISPParameters/>
			<ISQLParameters/>
			<IFormElements/>
			<USPParameters/>
			<USQLParameters/>
			<UConditions/>
			<UFormElements/>
			<DSPParameters/>
			<DSQLParameters/>
			<DConditions/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
			<PKFields/>
		</Record>
		<Grid id="105" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="10" connection="Datos" name="peticiones_estados_estado" dataSource="peticiones, estados, estados_pagos, pacientes, procedencias" pageSizeLimit="100" wizardCaption="Lista de Peticiones, Estados, Estados Pagos, Pacientes, Procedencias " wizardTheme="Inline" wizardThemeType="File" wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAllowInsert="False" wizardAltRecord="False" wizardRecordSeparator="False" activeCollection="TableParameters" orderBy="peticion_id" PathID="peticiones_estados_estado">
			<Components>
				<Label id="132" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="peticiones_estados_estado_TotalRecords" wizardTheme="Inline" wizardThemeType="File" wizardUseTemplateBlock="False">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Retrieve number of records" actionCategory="Database" id="133"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Sorter id="146" visible="True" name="Sorter_peticion_id" column="peticion_id" wizardCaption="Peticion Id" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="peticion_id" PathID="peticiones_estados_estadoSorter_peticion_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="147" visible="True" name="Sorter_fecha" column="fecha" wizardCaption="Fecha" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="fecha" PathID="peticiones_estados_estadoSorter_fecha">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="144" visible="True" name="Sorter_nombres" column="nombres" wizardCaption="Nombres" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="nombres" PathID="peticiones_estados_estadoSorter_nombres">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="145" visible="True" name="Sorter_apellidos" column="apellidos" wizardCaption="Apellidos" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="apellidos" PathID="peticiones_estados_estadoSorter_apellidos">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="142" visible="True" name="Sorter_rut" column="rut" wizardCaption="Rut" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="rut" PathID="peticiones_estados_estadoSorter_rut">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="143" visible="True" name="Sorter_ficha" column="ficha" wizardCaption="Ficha" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="ficha" PathID="peticiones_estados_estadoSorter_ficha">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="148" visible="True" name="Sorter_nom_procedencia" column="nom_procedencia" wizardCaption="Nom Procedencia" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="nom_procedencia" PathID="peticiones_estados_estadoSorter_nom_procedencia">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="140" visible="True" name="Sorter_nom_estado" column="nom_estado" wizardCaption="Nom Estado" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="nom_estado" PathID="peticiones_estados_estadoSorter_nom_estado">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="141" visible="True" name="Sorter_nom_estado_pago" column="nom_estado_pago" wizardCaption="Nom Estado Pago" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="nom_estado_pago" PathID="peticiones_estados_estadoSorter_nom_estado_pago">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Link id="174" fieldSourceType="DBColumn" dataType="Text" html="True" editable="False" name="img_pendiente" wizardTheme="Inline" wizardThemeType="File" hrefType="Page" urlType="Relative" preserveParameters="GET" visible="Yes" PathID="peticiones_estados_estadoimg_pendiente">
					<Components/>
					<Events/>
					<LinkParameters/>
					<Attributes/>
					<Features/>
				</Link>
				<ImageLink id="159" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" editable="False" name="ImageLink1" wizardTheme="Inline" wizardThemeType="File" hrefSource="det_Peticion.ccp" visible="Yes" PathID="peticiones_estados_estadoImageLink1">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="166" sourceType="DataField" name="peticion_id" source="peticion_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</ImageLink>
				<ImageLink id="202" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" editable="False" name="ImageLink2" wizardTheme="Inline" wizardThemeType="File" hrefSource="add_resultados_peticion2.ccp" visible="Yes" PathID="peticiones_estados_estadoImageLink2">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="203" sourceType="DataField" name="s_peticion_id" source="peticion_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</ImageLink>
				<ImageLink id="161" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" editable="False" name="ImageLink3" wizardTheme="Inline" wizardThemeType="File" hrefSource="validar_resultados_peticion.ccp" visible="Yes" PathID="peticiones_estados_estadoImageLink3">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="162" sourceType="DataField" name="s_peticion_id" source="peticion_id"/>
						<LinkParameter id="163" sourceType="DataField" name="peticion_id" source="peticion_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</ImageLink>
				<Label id="155" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="False" name="peticion_id" fieldSource="peticion_id" wizardCaption="Peticion Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="156" fieldSourceType="DBColumn" dataType="Date" html="False" editable="False" name="fecha" fieldSource="fecha" wizardCaption="Fecha" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" format="dd/mm/yyyy" DBFormat="yyyy-mm-dd HH:nn:ss">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="153" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nombres" fieldSource="nombres" wizardCaption="Nombres" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="154" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="apellidos" fieldSource="apellidos" wizardCaption="Apellidos" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="151" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="rut" fieldSource="rut" wizardCaption="Rut" wizardTheme="Inline" wizardThemeType="File" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="152" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="ficha" fieldSource="ficha" wizardCaption="Ficha" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="157" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nom_procedencia" fieldSource="nom_procedencia" wizardCaption="Nom Procedencia" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="149" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nom_estado" fieldSource="nom_estado" wizardCaption="Nom Estado" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="150" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nom_estado_pago" fieldSource="nom_estado_pago" wizardCaption="Nom Estado Pago" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="168" fieldSourceType="DBColumn" dataType="Text" html="True" editable="False" name="pendiente" wizardTheme="Inline" wizardThemeType="File">
					<Components/>
					<Events>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="169" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="pid" wizardTheme="Inline" wizardThemeType="File" fieldSource="peticion_id" PathID="peticiones_estados_estadopid">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Navigator id="158" type="Simple" name="Navigator" wizardPagingType="Custom" wizardFirst="True" wizardFirstText="Inicio" wizardPrev="True" wizardPrevText="Anterior" wizardNext="True" wizardNextText="Siguiente" wizardLast="True" wizardLastText="Final" wizardImages="True" wizardPageNumbers="Simple" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="True" wizardOfText="de" wizardTheme="Inline" wizardThemeType="File" wizardImagesScheme="Inline" size="10" pageSizes="1;5;10;25;50" PathID="peticiones_estados_estadoNavigator">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
			</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="175"/>
					</Actions>
				</Event>
				<Event name="BeforeBuildSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="201"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="134" conditionType="Parameter" useIsNull="False" field="peticion_id" parameterSource="s_peticion_id" dataType="Integer" logicOperator="Or" searchConditionType="Equal" parameterType="URL" orderNumber="1"/>
				<TableParameter id="135" conditionType="Parameter" useIsNull="False" field="fecha" parameterSource="s_fecha_ini" dataType="Date" logicOperator="And" searchConditionType="GreaterThanOrEqual" parameterType="URL" orderNumber="2" defaultValue="date(&quot;d/m/Y&quot;)" leftBrackets="2"/>
				<TableParameter id="172" conditionType="Parameter" useIsNull="False" field="peticiones.fecha" dataType="Date" searchConditionType="LessThanOrEqual" parameterType="URL" logicOperator="And" defaultValue="date(&quot;d/m/Y&quot;)" parameterSource="s_fecha_fin" orderNumber="7" rightBrackets="1"/>
				<TableParameter id="136" conditionType="Parameter" useIsNull="False" field="nombres" parameterSource="s_nombres" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="3" leftBrackets="0"/>
				<TableParameter id="137" conditionType="Parameter" useIsNull="False" field="apellidos" parameterSource="s_apellidos" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="4" rightBrackets="0"/>
				<TableParameter id="139" conditionType="Parameter" useIsNull="False" field="peticiones.estado_id" parameterSource="s_estado_id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="6"/>
				<TableParameter id="177" conditionType="Parameter" useIsNull="False" field="peticiones.estado_pago_id" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="s_estado_pago_id" orderNumber="8" rightBrackets="1"/>
				<TableParameter id="206" conditionType="Parameter" useIsNull="False" field="pacientes.rut" dataType="Text" searchConditionType="Contains" parameterType="URL" logicOperator="And" parameterSource="s_rut"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="106" tableName="peticiones" posWidth="145" posHeight="331" posLeft="10" posTop="10"/>
				<JoinTable id="108" tableName="estados" posWidth="100" posHeight="100" posLeft="606" posTop="88"/>
				<JoinTable id="110" tableName="estados_pagos" posWidth="100" posHeight="100" posLeft="593" posTop="207"/>
				<JoinTable id="112" tableName="pacientes" posWidth="102" posHeight="459" posLeft="283" posTop="2"/>
				<JoinTable id="117" tableName="procedencias" posWidth="100" posHeight="100" posLeft="449" posTop="19"/>
			</JoinTables>
			<JoinLinks>
				<JoinTable2 id="119" fieldLeft="peticiones.estado_id" fieldRight="estados.estado_id" tableLeft="peticiones" tableRight="estados" conditionType="Equal" joinType="left"/>
				<JoinTable2 id="120" fieldLeft="peticiones.estado_pago_id" fieldRight="estados_pagos.estado_pago_id" tableLeft="peticiones" tableRight="estados_pagos" conditionType="Equal" joinType="left"/>
				<JoinTable2 id="121" fieldLeft="peticiones.paciente_id" fieldRight="pacientes.paciente_id" tableLeft="peticiones" tableRight="pacientes" conditionType="Equal" joinType="left"/>
				<JoinTable2 id="122" fieldLeft="peticiones.procedencia_id" fieldRight="procedencias.procedencia_id" tableLeft="peticiones" tableRight="procedencias" conditionType="Equal" joinType="left"/>
			</JoinLinks>
			<Fields>
				<Field id="107" tableName="peticiones" fieldName="peticiones.*"/>
				<Field id="109" tableName="estados" fieldName="nom_estado"/>
				<Field id="111" tableName="estados_pagos" fieldName="nom_estado_pago"/>
				<Field id="113" tableName="pacientes" fieldName="rut"/>
				<Field id="114" tableName="pacientes" fieldName="ficha"/>
				<Field id="115" tableName="pacientes" fieldName="nombres"/>
				<Field id="116" tableName="pacientes" fieldName="apellidos"/>
				<Field id="118" tableName="procedencias" fieldName="nom_procedencia"/>
			</Fields>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
			<PKFields/>
		</Grid>
		<IncludePage id="96" hasOperation="True" name="calendar_tag" wizardTheme="InLine" wizardThemeType="File" page="calendar_tag.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="ver_Peticiones_events.php" comment="//" codePage="utf-8" forShow="False"/>
		<CodeFile id="Code" language="PHPTemplates" name="ver_Peticiones.php" comment="//" codePage="utf-8" forShow="True" url="ver_Peticiones.php"/>
	</CodeFiles>
	<SecurityGroups>
		<Group id="182" groupID="4"/>
		<Group id="183" groupID="5"/>
		<Group id="184" groupID="6"/>
		<Group id="185" groupID="7"/>
		<Group id="186" groupID="8"/>
		<Group id="187" groupID="9"/>
		<Group id="188" groupID="10"/>
		<Group id="189" groupID="11"/>
		<Group id="190" groupID="12"/>
		<Group id="191" groupID="13"/>
		<Group id="192" groupID="14"/>
		<Group id="193" groupID="15"/>
		<Group id="194" groupID="16"/>
		<Group id="195" groupID="17"/>
		<Group id="196" groupID="18"/>
		<Group id="197" groupID="19"/>
		<Group id="198" groupID="20"/>
	</SecurityGroups>
	<Events>
		<Event name="BeforeOutput" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="204"/>
			</Actions>
		</Event>
	</Events>
	<CachingParameters/>
	<Attributes/>
	<Features/>
</Page>

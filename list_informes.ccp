<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" wizardTheme="InLine" wizardThemeType="File" needGeneration="0" accessDeniedPage="login.ccp" cachingEnabled="False" cachingDuration="1 minutes" isService="False">
	<Components>
		<IncludePage id="71" hasOperation="True" name="avisos" wizardTheme="InLine" wizardThemeType="File" page="avisos.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="All" debugMode="False" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="informe_datosSearch" wizardCaption="Buscar Informe Datos " wizardTheme="Inline" wizardThemeType="File" wizardOrientation="Vertical" wizardFormMethod="post" returnPage="list_informes.ccp" PathID="informe_datosSearch">
			<Components>
				<TextBox id="5" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="s_peticion_id" wizardCaption="Peticion Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" visible="Yes" PathID="informe_datosSearchs_peticion_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="8" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="s_paciente" wizardCaption="Nombres" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" visible="Yes" PathID="informe_datosSearchs_paciente">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="6" fieldSourceType="DBColumn" dataType="Date" html="False" editable="True" hasErrorCollection="True" name="s_fecha_ini" wizardCaption="Fecha" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" DBFormat="yyyy-mm-dd HH:nn:ss" format="dd/mm/yyyy" defaultValue="CurrentDate" required="True" caption="Fecha Inicial" visible="Yes" PathID="informe_datosSearchs_fecha_ini">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="24" fieldSourceType="DBColumn" dataType="Date" html="False" editable="True" hasErrorCollection="True" name="s_fecha_fin" wizardTheme="Inline" wizardThemeType="File" DBFormat="yyyy-mm-dd HH:nn:ss" format="dd/mm/yyyy" defaultValue="CurrentDate" required="True" caption="Fecha Final" visible="Yes" PathID="informe_datosSearchs_fecha_fin">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="81" fieldSourceType="DBColumn" sourceType="Table" dataType="Integer" editable="True" hasErrorCollection="True" returnValueType="Number" name="s_procedencia_id" wizardTheme="Inline" wizardThemeType="File" wizardEmptyCaption="Seleccionar Valor" connection="Datos" dataSource="procedencias" boundColumn="procedencia_id" textColumn="nom_procedencia" activeCollection="TableParameters" activeTableType="dataSource" orderBy="nom_procedencia" visible="Yes" PathID="informe_datosSearchs_procedencia_id">
					<Components/>
					<Events/>
					<TableParameters>
						<TableParameter id="82" conditionType="Expression" useIsNull="False" field="procedencia_id" dataType="Integer" searchConditionType="Equal" parameterType="Expression" logicOperator="Or" parameterSource="GetUserProcedenciaID()" orderNumber="1" expression="&quot;. GetCondicion('procedencia') .&quot;"/>
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
				<Panel id="105" visible="True" name="Panel1" wizardTheme="Inline" wizardThemeType="File" PathID="informe_datosSearchPanel1">
					<Components>
						<CheckBox id="109" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="filtra" wizardTheme="Inline" wizardThemeType="File" checkedValue="1" uncheckedValue="0" PathID="informe_datosSearchPanel1filtra" defaultValue="Unchecked">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</CheckBox>
					</Components>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="106"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Panel>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Buscar" PathID="informe_datosSearchButton_DoSearch">
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
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" name="informe_datos" connection="Datos" dataSource="SELECT DISTINCT informe_datos.peticion_id, informe_datos.nom_procedencia, pacientes.nombres, pacientes.apellidos , informe_datos.fecha, informe_datos.nom_procedencia FROM informe_datos LEFT OUTER JOIN pacientes ON (informe_datos.paciente_id = pacientes.paciente_id) 
WHERE 
(informe_datos.fecha BETWEEN '{s_fecha_ini}' AND '{s_fecha_fin}') 
AND 
(informe_datos.procedencia_id={s_procedencia_id} or '0'='{s_procedencia_id}')
AND
(informe_datos.procedencia_id={proc_user} OR {s_nivel} &gt; 4)
ORDER BY
informe_datos.peticion_id" wizardCaption="Lista de Informe Datos " wizardTheme="Inline" wizardThemeType="File" wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAllowInsert="False" wizardAltRecord="False" wizardRecordSeparator="False" wizardAllowSorting="True" activeCollection="SQLParameters" activeTableType="dataSource" parameterTypeListName="ParameterTypeList" PathID="informe_datos">
			<Components>
				<Sorter id="16" visible="True" name="Sorter_peticion_id" column="peticion_id" wizardCaption="Peticion Id" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="peticion_id" PathID="informe_datosSorter_peticion_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<ImageLink id="100" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" editable="False" name="lnkInforme" wizardTheme="Inline" wizardThemeType="File" hrefSource="list_informes.ccp" visible="Yes" PathID="informe_datoslnkInforme">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="101" sourceType="DataField" name="peticion_id" source="peticion_id"/>
						<LinkParameter id="102" sourceType="DataField" name="s_nombres" source="nombres"/>
						<LinkParameter id="103" sourceType="DataField" name="s_apellidos" source="apellidos"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</ImageLink>
				<Link id="19" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="False" name="peticion_id" fieldSource="peticion_id" wizardCaption="Peticion Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" hrefType="Page" urlType="Relative" preserveParameters="GET" hrefSource="list_informes.ccp" removeParameters="aviso" visible="Yes" PathID="informe_datospeticion_id">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="45" sourceType="DataField" name="peticion_id" source="peticion_id"/>
						<LinkParameter id="66" sourceType="DataField" name="s_apellidos" source="apellidos"/>
						<LinkParameter id="67" sourceType="DataField" name="s_nombres" source="nombres"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="20" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nombres" fieldSource="nombres" wizardCaption="Nombres" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="21" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="apellidos" fieldSource="apellidos" wizardCaption="Apellidos" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="26" fieldSourceType="DBColumn" dataType="Date" html="False" editable="False" name="fecha" wizardTheme="Inline" wizardThemeType="File" format="dd/mm/yyyy" DBFormat="yyyy-mm-dd HH:nn:ss" fieldSource="fecha">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events>
				<Event name="AfterExecuteSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="32"/>
					</Actions>
				</Event>
				<Event name="BeforeExecuteSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="72"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="12" conditionType="Parameter" useIsNull="False" field="peticion_id" parameterSource="s_peticion_id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1"/>
				<TableParameter id="13" conditionType="Parameter" useIsNull="False" field="fecha" parameterSource="s_fecha_ini" dataType="Date" logicOperator="And" searchConditionType="GreaterThanOrEqual" parameterType="URL" orderNumber="2" leftBrackets="1" DBFormat="yyyy-mm-dd HH:nn:ss" format="dd/mm/yyyy"/>
				<TableParameter id="27" conditionType="Parameter" useIsNull="False" field="fecha" dataType="Date" searchConditionType="LessThanOrEqual" parameterType="URL" logicOperator="And" parameterSource="fecha" orderNumber="5" rightBrackets="1" DBFormat="yyyy-mm-dd HH:nn:ss" format="dd/mm/yyyy"/>
				<TableParameter id="14" conditionType="Parameter" useIsNull="False" field="nombres" parameterSource="s_nombres" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="3"/>
				<TableParameter id="15" conditionType="Parameter" useIsNull="False" field="apellidos" parameterSource="s_apellidos" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="4"/>
			</TableParameters>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="29" variable="s_fecha_ini" parameterType="URL" dataType="Date" format="dd/mm/yyyy" DBFormat="yyyy/mm/dd " parameterSource="s_fecha_ini" defaultValue="time()"/>
				<SQLParameter id="30" variable="s_fecha_fin" parameterType="URL" dataType="Date" format="dd/mm/yyyy" DBFormat="yyyy/mm/dd" parameterSource="s_fecha_fin" defaultValue="time()"/>
				<SQLParameter id="84" variable="s_procedencia_id" parameterType="URL" dataType="Text" parameterSource="s_procedencia_id" defaultValue="0"/>
				<SQLParameter id="85" variable="s_nivel" parameterType="Expression" dataType="Text" parameterSource="CCGetGroupID()"/>
				<SQLParameter id="86" variable="proc_user" parameterType="Expression" dataType="Text" parameterSource="GetUserProcedenciaID()"/>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
			<PKFields/>
		</Grid>
		<IncludePage id="60" hasOperation="True" name="calendar_tag" wizardTheme="InLine" wizardThemeType="File" page="calendar_tag.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
		<Panel id="110" visible="Dynamic" name="Panel1" wizardTheme="InLine" wizardThemeType="File" PathID="Panel1" features="(assigned)" generateDiv="True">
			<Components>
				<Grid id="112" secured="False" sourceType="SQL" returnValueType="Number" name="informe_datos2" connection="Datos" dataSource="SELECT DISTINCT 
MAX(serie) as serie,
informe_id, 
nom_informe
FROM informe_datos
WHERE peticion_id = {peticion_id}
GROUP BY informe_id, nom_informe" wizardCaption="Lista de Informe Datos " wizardTheme="Inline" wizardThemeType="File" wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAllowInsert="False" wizardAltRecord="False" wizardRecordSeparator="False" activeCollection="TableParameters" activeTableType="dataSource" wizardAllowSorting="True" PathID="Panel1informe_datos2">
					<Components>
						<Label id="113" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="False" name="peticion_id" wizardTheme="Inline" wizardThemeType="File" hasErrorCollection="True">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Label>
						<Label id="114" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="s_nombres" wizardTheme="Inline" wizardThemeType="File">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Label>
						<Label id="115" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="s_apellidos" wizardTheme="Inline" wizardThemeType="File">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Label>
						<Hidden id="116" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="s_fecha_ini" wizardTheme="Inline" wizardThemeType="File" PathID="Panel1informe_datos2s_fecha_ini">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Hidden>
						<Hidden id="117" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="s_fecha_fin" wizardTheme="Inline" wizardThemeType="File" PathID="Panel1informe_datos2s_fecha_fin">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Hidden>
						<Hidden id="118" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="s_paciente" wizardTheme="Inline" wizardThemeType="File" PathID="Panel1informe_datos2s_paciente">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Hidden>
						<Hidden id="119" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="s_peticion_id" wizardTheme="Inline" wizardThemeType="File" PathID="Panel1informe_datos2s_peticion_id">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Hidden>
						<Hidden id="120" fieldSourceType="CodeExpression" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="x_peticion_id" wizardTheme="Inline" wizardThemeType="File" fieldSource="CCGetParam(&quot;peticion_id&quot;,&quot;&quot;)" PathID="Panel1informe_datos2x_peticion_id">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Hidden>
						<Hidden id="121" fieldSourceType="CodeExpression" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="nom_paciente" wizardTheme="Inline" wizardThemeType="File" fieldSource="CCGetParam(&quot;s_nombres&quot;,&quot;&quot;) . &quot; &quot; . CCGetParam(&quot;s_apellidos&quot;,&quot;&quot;)" PathID="Panel1informe_datos2nom_paciente">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Hidden>
						<Label id="122" fieldSourceType="DBColumn" dataType="Text" html="True" editable="False" name="lbl_icono" wizardTheme="Inline" wizardThemeType="File">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Label>
						<Label id="123" fieldSourceType="DBColumn" dataType="Text" html="True" editable="False" name="lbl_chk" wizardTheme="Inline" wizardThemeType="File">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Label>
						<Label id="124" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nom_informe" fieldSource="nom_informe" wizardCaption="Nom Informe" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Label>
						<Hidden id="125" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="serie" wizardTheme="Inline" wizardThemeType="File" fieldSource="serie" PathID="Panel1informe_datos2serie">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Hidden>
						<Hidden id="126" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="informe_id" wizardTheme="Inline" wizardThemeType="File" fieldSource="informe_id" PathID="Panel1informe_datos2informe_id">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Hidden>
						<Label id="127" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="firma_nombre" wizardTheme="Inline" wizardThemeType="File">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Label>
						<Label id="128" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="fecha_firma" wizardTheme="Inline" wizardThemeType="File" fieldSource="serie">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Label>
						<Button id="129" urlType="Relative" enableValidation="True" isDefault="False" name="Imprimir" wizardTheme="Inline" wizardThemeType="File" PathID="Panel1informe_datos2Imprimir">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Button>
					</Components>
					<Events>
						<Event name="BeforeShowRow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="130"/>
							</Actions>
						</Event>
						<Event name="BeforeExecuteSelect" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="131"/>
							</Actions>
						</Event>
					</Events>
					<TableParameters>
						<TableParameter id="132" conditionType="Parameter" useIsNull="False" field="peticion_id" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="peticion_id" orderNumber="1" defaultValue="0"/>
					</TableParameters>
					<JoinTables>
					</JoinTables>
					<JoinLinks/>
					<Fields>
					</Fields>
					<SPParameters/>
					<SQLParameters>
						<SQLParameter id="133" variable="peticion_id" parameterType="URL" dataType="Integer" parameterSource="peticion_id" defaultValue="0"/>
					</SQLParameters>
					<SecurityGroups/>
					<Attributes/>
					<Features/>
					<PKFields/>
				</Grid>
			</Components>
			<Events/>
			<Attributes/>
			<Features>
				<JUpdatePanel id="111" enabled="True" childrenAsTriggers="True" name="UpdatePanel" category="jQuery" featureNameChanged="No" ccsIdsOnly="False" refresh="informe_datoslnkInforme.onclick;informe_datospeticion_id.onclick;">
					<Components/>
					<Events/>
					<Features/>
					<ControlPoints/>
				</JUpdatePanel>
			</Features>
		</Panel>
		<Grid id="34" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="20" name="informe_datos1" connection="Datos" dataSource="SELECT DISTINCT 
MAX(serie) as serie,
informe_id, 
nom_informe
FROM informe_datos
WHERE peticion_id = {peticion_id}
GROUP BY informe_id, nom_informe" PathID="informe_datos1">
			<Components>
				<Label id="59" fieldSourceType="DBColumn" dataType="Integer" html="False" name="peticion_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="63" fieldSourceType="DBColumn" dataType="Text" html="False" name="s_nombres">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="65" fieldSourceType="DBColumn" dataType="Text" html="False" name="s_apellidos">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="73" fieldSourceType="DBColumn" dataType="Text" name="s_fecha_ini" PathID="informe_datos1s_fecha_ini">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="74" fieldSourceType="DBColumn" dataType="Text" name="s_fecha_fin" PathID="informe_datos1s_fecha_fin">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="75" fieldSourceType="DBColumn" dataType="Text" name="s_paciente" PathID="informe_datos1s_paciente">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="76" fieldSourceType="DBColumn" dataType="Text" name="s_peticion_id" PathID="informe_datos1s_peticion_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="78" fieldSourceType="CodeExpression" dataType="Text" name="x_peticion_id" fieldSource="CCGetParam(&quot;peticion_id&quot;,&quot;&quot;)" PathID="informe_datos1x_peticion_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="79" fieldSourceType="CodeExpression" dataType="Text" name="nom_paciente" fieldSource="CCGetParam(&quot;s_nombres&quot;,&quot;&quot;) . &quot; &quot; . CCGetParam(&quot;s_apellidos&quot;,&quot;&quot;)" PathID="informe_datos1nom_paciente">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="55" fieldSourceType="DBColumn" dataType="Text" html="True" name="lbl_icono">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="70" fieldSourceType="DBColumn" dataType="Text" html="True" name="lbl_chk">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="41" fieldSourceType="DBColumn" dataType="Text" html="False" name="nom_informe" fieldSource="nom_informe">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="68" fieldSourceType="DBColumn" dataType="Text" name="serie" fieldSource="serie" PathID="informe_datos1serie">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="69" fieldSourceType="DBColumn" dataType="Integer" name="informe_id" fieldSource="informe_id" PathID="informe_datos1informe_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="77" fieldSourceType="DBColumn" dataType="Text" html="False" name="firma_nombre">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="99" fieldSourceType="DBColumn" dataType="Text" html="False" name="fecha_firma" fieldSource="serie">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Button id="58" urlType="Relative" enableValidation="True" isDefault="False" name="Imprimir" PathID="informe_datos1Imprimir">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
			</Components>
			<Events>
				<Event name="BeforeExecuteSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="134"/>
					</Actions>
				</Event>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="135"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="44" conditionType="Parameter" useIsNull="False" field="peticion_id" dataType="Integer" searchConditionType="Equal" parameterType="URL" parameterSource="peticion_id" logicOperator="And" defaultValue="0" orderNumber="1"/>
			</TableParameters>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="46" variable="peticion_id" dataType="Integer" parameterType="URL" parameterSource="peticion_id" defaultValue="0"/>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
			<PKFields/>
		</Grid>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="list_informes.php" comment="//" codePage="utf-8" forShow="True" url="list_informes.php"/>
		<CodeFile id="Events" language="PHPTemplates" forShow="False" name="list_informes_events.php" codePage="utf-8" comment="//"/>
	</CodeFiles>
	<SecurityGroups>
		<Group id="88" groupID="4"/>
		<Group id="89" groupID="5"/>
		<Group id="90" groupID="12"/>
		<Group id="91" groupID="13"/>
		<Group id="92" groupID="14"/>
		<Group id="93" groupID="15"/>
		<Group id="94" groupID="16"/>
		<Group id="95" groupID="17"/>
		<Group id="96" groupID="18"/>
		<Group id="97" groupID="19"/>
		<Group id="98" groupID="20"/>
	</SecurityGroups>
	<Events>
		<Event name="AfterInitialize" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="80"/>
			</Actions>
		</Event>
		<Event name="BeforeOutput" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="104"/>
			</Actions>
		</Event>
	</Events>
	<CachingParameters/>
	<Attributes/>
	<Features/>
</Page>

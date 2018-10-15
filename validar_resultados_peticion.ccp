<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" wizardTheme="InLine" wizardThemeType="File" needGeneration="0" accessDeniedPage="error_nivel.ccp" cachingEnabled="False" cachingDuration="1 minutes" isService="False">
	<Components>
		<Record id="18" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" debugMode="False" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="peticiones_pacientesSearch" wizardCaption="Buscar  " wizardTheme="Inline" wizardThemeType="File" wizardOrientation="Vertical" wizardFormMethod="post" returnPage="validar_resultados_peticion.ccp" PathID="peticiones_pacientesSearch">
			<Components>
				<TextBox id="21" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="s_peticion_id" wizardCaption="Peticion Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" required="True" caption="Número de Petición" visible="Yes" PathID="peticiones_pacientesSearchs_peticion_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Button id="19" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Buscar" PathID="peticiones_pacientesSearchButton_DoSearch">
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
		<Grid id="2" secured="False" sourceType="Table" returnValueType="Number" connection="Datos" name="peticiones_pacientes" dataSource="peticiones, pacientes" pageSizeLimit="100" wizardCaption="Lista de Peticiones, Pacientes " wizardTheme="Inline" wizardThemeType="File" wizardGridType="Tabular" wizardAllowInsert="False" wizardAltRecord="False" wizardRecordSeparator="False" activeCollection="TableParameters" activeTableType="dataSource" PathID="peticiones_pacientes">
			<Components>
				<Label id="15" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="False" name="peticion_id" fieldSource="peticion_id" wizardCaption="Peticion Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="17" fieldSourceType="DBColumn" dataType="Date" html="False" editable="False" name="fecha" fieldSource="fecha" wizardCaption="Fecha" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" format="dd/mm/yyyy" DBFormat="yyyy-mm-dd HH:nn:ss">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="156" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="paciente_id" wizardTheme="Inline" wizardThemeType="File" fieldSource="peticiones_paciente_id" PathID="peticiones_pacientespaciente_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="185" fieldSourceType="DBColumn" dataType="Date" html="False" editable="False" name="Hora" wizardTheme="Inline" wizardThemeType="File" fieldSource="hora" format="H:nn" DBFormat="yyyy-mm-dd HH:nn:ss">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="12" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nombres" fieldSource="nombres" wizardCaption="Nombres" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="13" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="apellidos" fieldSource="apellidos" wizardCaption="Apellidos" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="14" fieldSourceType="DBColumn" dataType="Date" html="False" editable="False" name="fecha_nacimiento" fieldSource="fecha_nacimiento" wizardCaption="Fecha Nacimiento" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" format="dd/mm/yyyy" DBFormat="yyyy-mm-dd HH:nn:ss">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="155" fieldSourceType="DBColumn" dataType="Text" html="True" editable="False" name="Edad" wizardTheme="Inline" wizardThemeType="File">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="371"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="20" conditionType="Parameter" useIsNull="False" field="peticion_id" parameterSource="s_peticion_id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1" defaultValue="0"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="186" tableName="peticiones" posWidth="153" posHeight="283" posLeft="10" posTop="10"/>
				<JoinTable id="191" tableName="pacientes" posWidth="198" posHeight="281" posLeft="221" posTop="9"/>
			</JoinTables>
			<JoinLinks>
				<JoinTable2 id="195" fieldLeft="peticiones.paciente_id" fieldRight="pacientes.paciente_id" tableLeft="peticiones" tableRight="pacientes" conditionType="Equal" joinType="inner"/>
			</JoinLinks>
			<Fields>
				<Field id="187" tableName="peticiones" fieldName="peticion_id"/>
				<Field id="188" tableName="peticiones" alias="peticiones_paciente_id" fieldName="peticiones.paciente_id"/>
				<Field id="189" tableName="peticiones" fieldName="fecha"/>
				<Field id="190" tableName="peticiones" fieldName="hora"/>
				<Field id="192" tableName="pacientes" fieldName="nombres"/>
				<Field id="193" tableName="pacientes" fieldName="apellidos"/>
				<Field id="194" tableName="pacientes" fieldName="fecha_nacimiento"/>
			</Fields>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
			<PKFields/>
		</Grid>
		<Record id="71" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" debugMode="False" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="test_resultados_estadosSearch" wizardCaption="Buscar Test, Resultados, Estados " wizardTheme="Inline" wizardThemeType="File" wizardOrientation="Vertical" wizardFormMethod="post" returnPage="validar_resultados_peticion.ccp" PathID="test_resultados_estadosSearch">
			<Components>
				<Hidden id="154" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="s_peticion_id" wizardTheme="Inline" wizardThemeType="File" required="True" caption="Número de Petición" PathID="test_resultados_estadosSearchs_peticion_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<ListBox id="74" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="s_secciones_id" wizardCaption="Secciones Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" sourceType="SQL" connection="Datos" dataSource="SELECT DISTINCT 
  secciones.nom_seccion,
  test.secciones_id
FROM
  peticiones_detalle
  LEFT OUTER JOIN test ON (peticiones_detalle.test_id = test.test_id)
  INNER JOIN secciones ON (test.secciones_id = secciones.seccion_id)
WHERE
  (peticiones_detalle.peticion_id = {s_peticion_id})
ORDER BY nom_seccion" boundColumn="secciones_id" textColumn="nom_seccion" activeCollection="SQLParameters" activeTableType="dataSource" orderBy="nom_seccion" parameterTypeListName="ParameterTypeList" visible="Yes" PathID="test_resultados_estadosSearchs_secciones_id">
					<Components/>
					<Events/>
					<TableParameters>
						<TableParameter id="119" conditionType="Parameter" useIsNull="False" field="peticiones_detalle.detalle_peticion_id" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" defaultValue="0" parameterSource="s_peticion_id" orderNumber="1"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters>
						<SQLParameter id="120" variable="s_peticion_id" parameterType="URL" dataType="Integer" parameterSource="s_peticion_id" defaultValue="0"/>
					</SQLParameters>
					<JoinTables>
						<JoinTable id="111" tableName="secciones" posWidth="100" posHeight="100" posLeft="410" posTop="48"/>
						<JoinTable id="113" tableName="peticiones_detalle" posWidth="146" posHeight="277" posLeft="10" posTop="10"/>
						<JoinTable id="115" tableName="test" posWidth="100" posHeight="176" posLeft="223" posTop="14"/>
					</JoinTables>
					<JoinLinks>
						<JoinTable2 id="117" fieldLeft="peticiones_detalle.test_id" fieldRight="test.test_id" tableLeft="peticiones_detalle" tableRight="test" conditionType="Equal" joinType="left"/>
						<JoinTable2 id="118" fieldLeft="test.secciones_id" fieldRight="secciones.seccion_id" tableLeft="test" tableRight="secciones" joinType="inner"/>
					</JoinLinks>
					<Fields>
						<Field id="112" tableName="secciones" fieldName="nom_seccion"/>
						<Field id="114" tableName="peticiones_detalle" fieldName="peticiones_detalle.*"/>
						<Field id="116" tableName="test" fieldName="secciones_id"/>
					</Fields>
					<Attributes/>
					<Features/>
					<PKFields/>
				</ListBox>
				<ListBox id="75" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="s_equipo_id" wizardCaption="Equipo Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" sourceType="SQL" connection="Datos" dataSource="SELECT DISTINCT 
  equipos.nom_equipo,
  test.equipo_id
FROM
  peticiones_detalle
  LEFT OUTER JOIN test ON (peticiones_detalle.test_id = test.test_id)
  INNER JOIN equipos ON (test.equipo_id = equipos.equipo_id)
WHERE
  (peticiones_detalle.peticion_id = {s_peticion_id})
ORDER BY nom_equipo" boundColumn="equipo_id" textColumn="nom_equipo" activeCollection="TableParameters" activeTableType="dataSource" orderBy="nom_equipo" visible="Yes" PathID="test_resultados_estadosSearchs_equipo_id">
					<Components/>
					<Events>
					</Events>
					<TableParameters>
						<TableParameter id="137" conditionType="Parameter" useIsNull="False" field="peticiones_detalle.detalle_peticion_id" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" defaultValue="0" parameterSource="s_peticion_id" orderNumber="1"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters>
						<SQLParameter id="138" variable="s_peticion_id" parameterType="URL" dataType="Integer" parameterSource="s_peticion_id" defaultValue="0"/>
					</SQLParameters>
					<JoinTables>
						<JoinTable id="129" tableName="equipos" posWidth="100" posHeight="100" posLeft="375" posTop="26"/>
						<JoinTable id="131" tableName="peticiones_detalle" posWidth="131" posHeight="235" posLeft="66" posTop="53"/>
						<JoinTable id="133" tableName="test" posWidth="114" posHeight="271" posLeft="230" posTop="10"/>
					</JoinTables>
					<JoinLinks>
						<JoinTable2 id="135" fieldLeft="test.equipo_id" fieldRight="equipos.equipo_id" tableLeft="test" tableRight="equipos" conditionType="Equal" joinType="inner"/>
						<JoinTable2 id="136" fieldLeft="peticiones_detalle.test_id" fieldRight="test.test_id" tableLeft="peticiones_detalle" tableRight="test" conditionType="Equal" joinType="inner"/>
					</JoinLinks>
					<Fields>
						<Field id="130" tableName="equipos" fieldName="nom_equipo"/>
						<Field id="132" tableName="peticiones_detalle" fieldName="peticion_id"/>
						<Field id="134" tableName="test" fieldName="secciones_id"/>
					</Fields>
					<Attributes/>
					<Features/>
					<PKFields/>
				</ListBox>
				<Button id="72" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Buscar" PathID="test_resultados_estadosSearchButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
			</Components>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="370"/>
					</Actions>
				</Event>
			</Events>
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
		<Grid id="22" secured="False" sourceType="Table" returnValueType="Number" connection="Datos" dataSource="test, resultados, estados, peticiones_detalle" name="test_resultados_estados" wizardCaption="Lista de Test, Resultados, Estados " wizardTheme="Inline" wizardThemeType="File" wizardGridType="Tabular" wizardAllowInsert="False" wizardAltRecord="False" wizardRecordSeparator="False" activeCollection="TableParameters" activeTableType="dataSource" orderBy="test_main_id, decompuesto desc, orden_ingreso" PathID="test_resultados_estados">
			<Components>
				<Hidden id="250" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="s_peticion_id" wizardTheme="Inline" wizardThemeType="File" PathID="test_resultados_estadoss_peticion_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="244" fieldSourceType="DBColumn" dataType="Integer" html="True" editable="False" name="marcador" wizardTheme="Inline" wizardThemeType="File" fieldSource="resultado_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="249" fieldSourceType="DBColumn" dataType="Text" html="True" editable="False" name="lblDeCompuesto" wizardTheme="Inline" wizardThemeType="File">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="89" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="cod_test" fieldSource="cod_test" wizardCaption="Cod Test" wizardTheme="Inline" wizardThemeType="File" wizardSize="30" wizardMaxLength="30" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="88" fieldSourceType="DBColumn" dataType="Memo" html="False" editable="False" name="valor" fieldSource="valor" wizardCaption="Valor" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="91" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="unidad_medida" fieldSource="unidad_medida" wizardCaption="Unidad Medida" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="374" fieldSourceType="DBColumn" dataType="Text" html="False" name="repetido" wizardTheme="Inline" wizardThemeType="File" fieldSource="repetido">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Link id="299" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" editable="False" name="lnkHistoria" wizardTheme="Inline" wizardThemeType="File" visible="Yes" PathID="test_resultados_estadoslnkHistoria">
					<Components/>
					<Events>
					</Events>
					<LinkParameters/>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="80" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nom_estado" fieldSource="nom_estado" wizardCaption="Nom Estado" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="366"/>
					</Actions>
				</Event>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="368"/>
					</Actions>
				</Event>
				<Event name="BeforeBuildSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="369"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="76" conditionType="Parameter" useIsNull="False" field="resultados.peticion_id" parameterSource="s_peticion_id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1" defaultValue="0"/>
				<TableParameter id="77" conditionType="Parameter" useIsNull="False" field="test.secciones_id" parameterSource="s_secciones_id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="2"/>
				<TableParameter id="78" conditionType="Parameter" useIsNull="False" field="test.equipo_id" parameterSource="s_equipo_id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="3"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="342" tableName="test" posWidth="160" posHeight="180" posLeft="10" posTop="10"/>
				<JoinTable id="351" tableName="resultados" posWidth="166" posHeight="294" posLeft="310" posTop="16"/>
				<JoinTable id="357" tableName="estados" posWidth="100" posHeight="100" posLeft="417" posTop="377"/>
				<JoinTable id="359" tableName="peticiones_detalle" posWidth="113" posHeight="245" posLeft="637" posTop="12"/>
			</JoinTables>
			<JoinLinks>
				<JoinTable2 id="362" fieldLeft="resultados.test_id" fieldRight="test.test_id" tableLeft="resultados" tableRight="test" conditionType="Equal" joinType="left"/>
				<JoinTable2 id="363" fieldLeft="resultados.estado_id" fieldRight="estados.estado_id" tableLeft="resultados" tableRight="estados" conditionType="Equal" joinType="left"/>
				<JoinTable2 id="364" fieldLeft="peticiones_detalle.peticion_id" fieldRight="resultados.peticion_id" tableLeft="peticiones_detalle" tableRight="resultados" conditionType="Equal" joinType="right"/>
				<JoinTable2 id="365" fieldLeft="peticiones_detalle.test_id" fieldRight="resultados.test_id" tableLeft="peticiones_detalle" tableRight="resultados" joinType="inner"/>
			</JoinLinks>
			<Fields>
				<Field id="343" tableName="test" fieldName="secciones_id"/>
				<Field id="344" tableName="test" fieldName="equipo_id"/>
				<Field id="345" tableName="test" fieldName="cod_test"/>
				<Field id="346" tableName="test" fieldName="nom_test"/>
				<Field id="347" tableName="test" fieldName="unidad_medida"/>
				<Field id="348" tableName="test" fieldName="aislado"/>
				<Field id="349" tableName="test" fieldName="compuesto"/>
				<Field id="350" tableName="test" fieldName="formula"/>
				<Field id="352" tableName="resultados" fieldName="resultado_id"/>
				<Field id="353" tableName="resultados" alias="resultados_peticion_id" fieldName="resultados.peticion_id"/>
				<Field id="354" tableName="resultados" alias="resultados_test_id" fieldName="resultados.test_id"/>
				<Field id="355" tableName="resultados" alias="resultados_estado_id" fieldName="resultados.estado_id"/>
				<Field id="356" tableName="resultados" fieldName="valor"/>
				<Field id="358" tableName="estados" fieldName="nom_estado"/>
				<Field id="360" tableName="peticiones_detalle" fieldName="decompuesto"/>
				<Field id="361" tableName="peticiones_detalle" fieldName="test_main_id"/>
				<Field id="373" tableName="resultados" fieldName="repetido"/>
			</Fields>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
			<PKFields/>
		</Grid>
		<ImageLink id="337" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" editable="False" name="ImageLink1" wizardTheme="InLine" wizardThemeType="File" hrefSource="add_resultados_peticion2.ccp" visible="Yes" PathID="ImageLink1">
			<Components/>
			<Events/>
			<LinkParameters>
				<LinkParameter id="339" sourceType="URL" name="s_peticion_id" source="s_peticion_id"/>
			</LinkParameters>
			<Attributes/>
			<Features/>
		</ImageLink>
		<ImageLink id="338" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" editable="False" name="ImageLink2" wizardTheme="InLine" wizardThemeType="File" hrefSource="menu_principal.ccp" visible="Yes" PathID="ImageLink2">
			<Components/>
			<Events/>
			<LinkParameters/>
			<Attributes/>
			<Features/>
		</ImageLink>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="validar_resultados_peticion.php" comment="//" forShow="True" url="validar_resultados_peticion.php" codePage="utf-8"/>
		<CodeFile id="Events" language="PHPTemplates" forShow="False" name="validar_resultados_peticion_events.php" comment="//" codePage="utf-8"/>
	</CodeFiles>
	<SecurityGroups>
		<Group id="375" groupID="5"/>
		<Group id="376" groupID="12"/>
		<Group id="377" groupID="13"/>
		<Group id="378" groupID="14"/>
		<Group id="379" groupID="15"/>
		<Group id="380" groupID="16"/>
		<Group id="381" groupID="17"/>
		<Group id="382" groupID="18"/>
		<Group id="383" groupID="19"/>
		<Group id="384" groupID="20"/>
	</SecurityGroups>
	<Events>
		<Event name="AfterInitialize" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="367"/>
			</Actions>
		</Event>
		<Event name="BeforeOutput" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="372"/>
			</Actions>
		</Event>
	</Events>
	<CachingParameters/>
	<Attributes/>
	<Features/>
</Page>

<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" wizardTheme="InLine" wizardThemeType="File" needGeneration="0" cachingEnabled="False" cachingDuration="1 minutes" isService="False">
	<Components>
		<Record id="49" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="GET" debugMode="False" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="resultados_testSearch" wizardCaption="Buscar Resultados, Test " wizardTheme="Inline" wizardThemeType="File" wizardOrientation="Vertical" wizardFormMethod="post" returnPage="stat_historiapaciente.ccp" PathID="resultados_testSearch">
			<Components>
				<Label id="141" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="lbl_nom_paciente" wizardTheme="Inline" wizardThemeType="File">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="DLookup" actionCategory="Database" id="142" typeOfTarget="Control" expression="&quot;concat(nombres, ' ' , apellidos)&quot;" domain="pacientes" criteria="&quot;paciente_id=&quot; . CCGetParam(&quot;paciente_id&quot;,&quot;0&quot;)" connection="Datos" dataType="Text" target="lbl_nom_paciente"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<TextBox id="51" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="s_keyword" wizardCaption="Palabra clave" wizardTheme="Inline" wizardThemeType="File" wizardSize="30" wizardMaxLength="30" wizardIsPassword="False" visible="Yes" PathID="resultados_testSearchs_keyword">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Button id="50" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Buscar" PathID="resultados_testSearchButton_DoSearch">
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
		<Grid id="37" secured="False" sourceType="SQL" returnValueType="Number" connection="Datos" name="resultados_test" wizardCaption="Lista de Resultados, Test " wizardTheme="Inline" wizardThemeType="File" wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAllowInsert="False" wizardAltRecord="False" wizardRecordSeparator="False" activeCollection="TableParameters" activeTableType="dataSource" parameterTypeListName="ParameterTypeList" dataSource="SELECT DISTINCT count(*) as qty, test.test_id, cod_test, nom_test FROM (resultados LEFT JOIN peticiones ON
resultados.peticion_id = peticiones.peticion_id) LEFT JOIN test ON
resultados.test_id = test.test_id
WHERE ( test.cod_test LIKE '%{s_keyword}%'
OR test.cod_test LIKE '%{s_keyword}%' )
AND peticiones.paciente_id = {paciente_id} and test.compuesto='F' and test.aislado='V'
GROUP BY test.test_id, cod_test, nom_test
ORDER BY cod_test" orderBy="cod_test" wizardUsePageScroller="True" PathID="resultados_test">
			<Components>
				<Sorter id="54" visible="True" name="Sorter_cod_test" column="cod_test" wizardCaption="Cod Test" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="cod_test" PathID="resultados_testSorter_cod_test">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="55" visible="True" name="Sorter_nom_test" column="nom_test" wizardCaption="Nom Test" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="nom_test" PathID="resultados_testSorter_nom_test">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<ImageLink id="147" fieldSourceType="DBColumn" dataType="Text" html="True" name="lnkVerHistoria" wizardTheme="Inline" wizardThemeType="File" visible="Yes" hrefType="Page" urlType="Relative" preserveParameters="GET" PathID="resultados_testlnkVerHistoria">
					<Components/>
					<Events/>
					<LinkParameters/>
					<Attributes/>
					<Features/>
				</ImageLink>
				<Hidden id="149" fieldSourceType="DBColumn" dataType="Integer" name="test_id" wizardTheme="Inline" wizardThemeType="File" fieldSource="test_id" PathID="resultados_testtest_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="60" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="cod_test" fieldSource="cod_test" wizardCaption="Cod Test" wizardTheme="Inline" wizardThemeType="File" wizardSize="30" wizardMaxLength="30" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="61" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nom_test" fieldSource="nom_test" wizardCaption="Nom Test" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="145" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="False" name="qty" wizardTheme="Inline" wizardThemeType="File" fieldSource="qty">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<ImageLink id="144" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" editable="False" name="ImageLink1" wizardTheme="Inline" wizardThemeType="File" hrefSource="menu_principal.ccp" visible="Yes" PathID="resultados_testImageLink1">
					<Components/>
					<Events/>
					<LinkParameters/>
					<Attributes/>
					<Features/>
				</ImageLink>
			</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="148"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="52" conditionType="Parameter" useIsNull="False" field="test.cod_test" parameterSource="s_keyword" dataType="Text" logicOperator="Or" searchConditionType="Contains" parameterType="URL" orderNumber="1" leftBrackets="1"/>
				<TableParameter id="53" conditionType="Parameter" useIsNull="False" field="test.cod_test" parameterSource="s_keyword" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="2" rightBrackets="1"/>
				<TableParameter id="84" conditionType="Parameter" useIsNull="False" field="peticiones.paciente_id" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" defaultValue="0" parameterSource="paciente_id" orderNumber="3"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="128" tableName="peticiones" posWidth="100" posHeight="100" posLeft="10" posTop="10"/>
				<JoinTable id="130" tableName="resultados" posWidth="157" posHeight="318" posLeft="238" posTop="75"/>
				<JoinTable id="132" tableName="test" posWidth="100" posHeight="434" posLeft="442" posTop="17"/>
			</JoinTables>
			<JoinLinks>
				<JoinTable2 id="139" fieldLeft="resultados.peticion_id" fieldRight="peticiones.peticion_id" tableLeft="resultados" tableRight="peticiones" conditionType="Equal" joinType="left"/>
				<JoinTable2 id="140" fieldLeft="resultados.test_id" fieldRight="test.test_id" tableLeft="resultados" tableRight="test" conditionType="Equal" joinType="left"/>
			</JoinLinks>
			<Fields>
				<Field id="129" tableName="peticiones" fieldName="paciente_id"/>
				<Field id="131" tableName="resultados" alias="resultados_test_id" fieldName="resultados.test_id"/>
				<Field id="133" tableName="test" fieldName="cod_test"/>
				<Field id="134" tableName="test" fieldName="nom_test"/>
				<Field id="135" tableName="test" fieldName="aislado"/>
				<Field id="136" tableName="test" fieldName="compuesto"/>
				<Field id="137" tableName="test" fieldName="formula"/>
				<Field id="138" tableName="test" fieldName="imprimible"/>
			</Fields>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="71" variable="s_keyword" parameterType="URL" dataType="Text" parameterSource="s_keyword"/>
				<SQLParameter id="85" variable="paciente_id" parameterType="URL" dataType="Integer" parameterSource="paciente_id" defaultValue="0"/>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
			<PKFields/>
		</Grid>
		<IncludePage id="150" name="Header" page="Header.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="stat_historiapaciente.php" comment="//" forShow="True" url="stat_historiapaciente.php" codePage="utf-8"/>
		<CodeFile id="Events" language="PHPTemplates" forShow="False" name="stat_historiapaciente_events.php" comment="//" codePage="utf-8"/>
	</CodeFiles>
	<SecurityGroups/>
	<Events>
		<Event name="BeforeOutput" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="146"/>
			</Actions>
		</Event>
	</Events>
	<CachingParameters/>
	<Attributes/>
	<Features/>
</Page>

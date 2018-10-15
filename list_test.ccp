<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" wizardTheme="InLine" wizardThemeType="File" needGeneration="0" accessDeniedPage="error_nivel.ccp" cachingEnabled="False" cachingDuration="1 minutes" isService="False">
	<Components>
		<Record id="4" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="GET" debugMode="False" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="testSearch" wizardCaption="Buscar Test " wizardTheme="Inline" wizardThemeType="File" wizardOrientation="Vertical" wizardFormMethod="post" returnPage="list_test.ccp" removeParameters="testPage" PathID="testSearch">
			<Components>
				<TextBox id="8" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="s_nom_test" wizardCaption="Nom Test" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" visible="Yes" PathID="testSearchs_nom_test">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="63" fieldSourceType="DBColumn" sourceType="Table" dataType="Integer" editable="True" hasErrorCollection="True" returnValueType="Number" name="s_seccion" wizardTheme="Inline" wizardThemeType="File" wizardEmptyCaption="Seleccionar Valor" connection="Datos" dataSource="secciones" boundColumn="seccion_id" textColumn="nom_seccion" activeCollection="TableParameters" activeTableType="dataSource" orderBy="nom_seccion" visible="Yes" PathID="testSearchs_seccion">
					<Components/>
					<Events/>
					<TableParameters>
						<TableParameter id="65" conditionType="Parameter" useIsNull="False" field="activo" dataType="Text" searchConditionType="Equal" parameterType="URL" logicOperator="And" defaultValue="'V'" parameterSource="activo" orderNumber="1"/>
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
				<ListBox id="64" fieldSourceType="DBColumn" sourceType="Table" dataType="Integer" editable="True" hasErrorCollection="True" returnValueType="Number" name="s_equipo" wizardTheme="Inline" wizardThemeType="File" wizardEmptyCaption="Seleccionar Valor" connection="Datos" dataSource="equipos" boundColumn="equipo_id" textColumn="nom_equipo" activeCollection="TableParameters" activeTableType="dataSource" orderBy="nom_equipo" visible="Yes" PathID="testSearchs_equipo">
					<Components/>
					<Events/>
					<TableParameters>
						<TableParameter id="66" conditionType="Parameter" useIsNull="False" field="activo" dataType="Text" searchConditionType="Equal" parameterType="URL" logicOperator="And" defaultValue="'V'" parameterSource="activo" orderNumber="1"/>
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
				<ListBox id="9" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="s_aislado" wizardCaption="Aislado" wizardTheme="Inline" wizardThemeType="File" wizardSize="1" wizardMaxLength="1" wizardIsPassword="False" checkedValue="V" uncheckedValue="F" sourceType="ListOfValues" _nameOfList="No aislados    " dataSource="V;Aislados;F;No aislados" _valueOfList="F" visible="Yes" PathID="testSearchs_aislado">
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
				<ListBox id="10" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="s_compuesto" wizardCaption="Compuesto" wizardTheme="Inline" wizardThemeType="File" wizardSize="1" wizardMaxLength="1" wizardIsPassword="False" checkedValue="V" uncheckedValue="F" sourceType="ListOfValues" _nameOfList="No Compuestos  " dataSource="V;Compuestos;F;No Compuestos" _valueOfList="F" visible="Yes" PathID="testSearchs_compuesto">
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
				<ListBox id="71" fieldSourceType="DBColumn" sourceType="ListOfValues" dataType="Text" editable="True" hasErrorCollection="True" returnValueType="Number" name="s_formula" wizardTheme="Inline" wizardThemeType="File" wizardEmptyCaption="Seleccionar Valor" _valueOfList="F" _nameOfList="Test NO es Fórmula" dataSource="V;Test es Fórmula;F;Test NO es Fórmula" visible="Yes" PathID="testSearchs_formula">
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
				<ListBox id="104" fieldSourceType="DBColumn" sourceType="ListOfValues" dataType="Text" editable="True" hasErrorCollection="True" returnValueType="Number" name="s_imprimible" wizardTheme="Inline" wizardThemeType="File" wizardEmptyCaption="Seleccionar Valor" connection="Datos" _nameOfList="SI de puede imprimir" _valueOfList="V" dataSource="V;SI de puede imprimir;F;NO se puede imprimir" visible="Yes" PathID="testSearchs_imprimible">
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
				<ListBox id="11" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="s_acceso_rapido" wizardCaption="Acceso Rapido" wizardTheme="Inline" wizardThemeType="File" wizardSize="1" wizardMaxLength="1" wizardIsPassword="False" checkedValue="V" uncheckedValue="F" sourceType="ListOfValues" _nameOfList="Todos            " dataSource="V;Acceso rápido;F;No acceso rápido" visible="Yes" PathID="testSearchs_acceso_rapido">
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
				<ListBox id="12" fieldSourceType="DBColumn" sourceType="ListOfValues" dataType="Text" editable="True" hasErrorCollection="True" returnValueType="Number" name="testPageSize" dataSource=";Seleccionar Valor;5;5;10;10;25;25;100;100" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Registro por página" wizardNoEmptyValue="True" visible="Yes" PathID="testSearchtestPageSize">
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
				<Button id="5" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Buscar" PathID="testSearchButton_DoSearch">
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
		<Grid id="3" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="10" name="test" connection="Datos" dataSource="test" pageSizeLimit="100" wizardCaption="Lista de Test " wizardTheme="Inline" wizardThemeType="File" wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAllowInsert="False" wizardAltRecord="True" wizardRecordSeparator="False" activeCollection="TableParameters" activeTableType="dataSource" orderBy="codigo_fonasa, cod_test, nom_test" wizardAllowSorting="True" wizardUsePageScroller="True" PathID="test">
			<Components>
				<Label id="13" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="test_TotalRecords" wizardTheme="Inline" wizardThemeType="File" wizardUseTemplateBlock="False">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Retrieve number of records" actionCategory="Database" id="14"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Sorter id="108" visible="True" name="Sort_codigo_fonasa" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="Simple" connection="Datos" column="codigo_fonasa" PathID="testSort_codigo_fonasa">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="22" visible="True" name="Sorter_cod_test" column="cod_test" wizardCaption="Cod Test" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="cod_test" PathID="testSorter_cod_test">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="23" visible="True" name="Sorter_nom_test" column="nom_test" wizardCaption="Nom Test" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="nom_test" PathID="testSorter_nom_test">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="126" visible="True" name="C" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="Simple" column="compuesto" PathID="testC">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="127" visible="True" name="F" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="Simple" column="formula" PathID="testF">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="128" visible="True" name="I" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="Simple" column="imprimible" PathID="testI">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="129" visible="True" name="A" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="Simple" connection="Datos" column="aislado" PathID="testA">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<ImageLink id="72" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" editable="False" name="ImageLink1" wizardTheme="Inline" wizardThemeType="File" hrefSource="add_test.ccp" visible="Yes" PathID="testImageLink1">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="80" sourceType="DataField" name="test_id" source="test_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</ImageLink>
				<ImageLink id="74" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" editable="False" name="ImageLink3" wizardTheme="Inline" wizardThemeType="File" hrefSource="add_valores_referencia.ccp" visible="Yes" PathID="testImageLink3">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="82" sourceType="DataField" name="test_id" source="test_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</ImageLink>
				<ImageLink id="78" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" editable="False" name="ImageLink7" wizardTheme="Inline" wizardThemeType="File" hrefSource="asignar_insumos_test.ccp" visible="Yes" PathID="testImageLink7">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="84" sourceType="DataField" name="test_id" source="test_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</ImageLink>
				<Hidden id="52" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="test_id" wizardTheme="Inline" wizardThemeType="File" fieldSource="test_id" PathID="testtest_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="40" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="h_compuesto" wizardTheme="Inline" wizardThemeType="File" fieldSource="compuesto" PathID="testh_compuesto">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="118" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="formula" wizardTheme="Inline" wizardThemeType="File" fieldSource="formula" PathID="testformula">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="119" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="imprimible" wizardTheme="Inline" wizardThemeType="File" fieldSource="imprimible" PathID="testimprimible">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="120" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="aislado" wizardTheme="Inline" wizardThemeType="File" fieldSource="aislado" PathID="testaislado">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="106" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="codigo_fonasa" wizardTheme="Inline" wizardThemeType="File" fieldSource="codigo_fonasa">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="26" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="cod_test" fieldSource="cod_test" wizardCaption="Cod Test" wizardTheme="Inline" wizardThemeType="File" wizardSize="30" wizardMaxLength="30" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="27" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nom_test" fieldSource="nom_test" wizardCaption="Nom Test" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Link id="110" fieldSourceType="DBColumn" dataType="Text" html="True" editable="False" name="lbl_compuesto" wizardTheme="Inline" wizardThemeType="File" hrefType="Page" urlType="Relative" preserveParameters="None" hrefSource="list_test.ccp" visible="Yes" PathID="testlbl_compuesto">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="122" sourceType="DataField" name="s_compuesto" source="compuesto"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Link id="111" fieldSourceType="DBColumn" dataType="Text" html="True" editable="False" name="lbl_formula" wizardTheme="Inline" wizardThemeType="File" hrefType="Page" urlType="Relative" preserveParameters="None" hrefSource="list_test.ccp" visible="Yes" PathID="testlbl_formula">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="123" sourceType="DataField" name="s_formula" source="formula"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Link id="112" fieldSourceType="DBColumn" dataType="Text" html="True" editable="False" name="lbl_imprimible" wizardTheme="Inline" wizardThemeType="File" hrefType="Page" urlType="Relative" preserveParameters="None" hrefSource="list_test.ccp" visible="Yes" PathID="testlbl_imprimible">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="124" sourceType="DataField" name="s_imprimible" source="imprimible"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Link id="113" fieldSourceType="DBColumn" dataType="Text" html="True" editable="False" name="lbl_aislado" wizardTheme="Inline" wizardThemeType="File" hrefType="Page" urlType="Relative" preserveParameters="None" hrefSource="list_test.ccp" visible="Yes" PathID="testlbl_aislado">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="125" sourceType="DataField" name="s_aislado" source="aislado"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Navigator id="121" type="Simple" name="Navigator1" wizardPagingType="Custom" wizardPageNumbers="Simple" wizardTotalPages="True" wizardImages="True" wizardHideDisabled="True" wizardFirst="True" wizardPrev="True" wizardNext="True" wizardLast="True" wizardFirstText="Inicio" wizardPrevText="Anterior" wizardNextText="Siguiente" wizardLastText="Final" wizardOfText="de" wizardTheme="InLine" wizardThemeType="File" wizardImagesScheme="Square" size="10" pageSizes="1;5;10;25;50" PathID="testNavigator1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<ImageLink id="69" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" editable="False" name="agregartest" wizardTheme="Inline" wizardThemeType="File" hrefSource="add_test.ccp" visible="Yes" PathID="testagregartest">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="70" sourceType="Expression" name="test_id" source="&quot;&quot;"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</ImageLink>
				<ImageLink id="130" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" editable="False" name="ImageLink2" wizardTheme="Inline" wizardThemeType="File" hrefSource="menu_principal.ccp" visible="Yes" PathID="testImageLink2">
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
						<Action actionName="Custom Code" actionCategory="General" id="90"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="16" conditionType="Parameter" useIsNull="False" field="cod_test" parameterSource="s_nom_test" dataType="Text" logicOperator="Or" searchConditionType="Contains" parameterType="URL" orderNumber="2" leftBrackets="1"/>
				<TableParameter id="109" conditionType="Parameter" useIsNull="False" field="codigo_fonasa" dataType="Text" searchConditionType="Contains" parameterType="URL" logicOperator="Or" parameterSource="s_nom_test" orderNumber="11" rightBrackets="0"/>
				<TableParameter id="17" conditionType="Parameter" useIsNull="False" field="nom_test" parameterSource="s_nom_test" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="3" rightBrackets="1"/>
				<TableParameter id="18" conditionType="Parameter" useIsNull="False" field="aislado" parameterSource="s_aislado" dataType="Text" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="4"/>
				<TableParameter id="19" conditionType="Parameter" useIsNull="False" field="compuesto" parameterSource="s_compuesto" dataType="Text" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="5"/>
				<TableParameter id="20" conditionType="Parameter" useIsNull="False" field="acceso_rapido" parameterSource="s_acceso_rapido" dataType="Text" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="6"/>
				<TableParameter id="67" conditionType="Parameter" useIsNull="False" field="equipo_id" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="s_equipo" orderNumber="7"/>
				<TableParameter id="68" conditionType="Parameter" useIsNull="False" field="secciones_id" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="s_seccion" orderNumber="8"/>
				<TableParameter id="103" conditionType="Parameter" useIsNull="False" field="formula" dataType="Text" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="s_formula" orderNumber="9"/>
				<TableParameter id="105" conditionType="Parameter" useIsNull="False" field="imprimible" dataType="Text" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="s_imprimible" orderNumber="10"/>
			</TableParameters>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
			<PKFields/>
		</Grid>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="list_test_events.php" comment="//" codePage="utf-8" forShow="False"/>
		<CodeFile id="Code" language="PHPTemplates" name="list_test.php" comment="//" codePage="utf-8" forShow="True" url="list_test.php"/>
	</CodeFiles>
	<SecurityGroups>
		<Group id="131" groupID="15"/>
		<Group id="132" groupID="16"/>
		<Group id="133" groupID="17"/>
		<Group id="134" groupID="18"/>
		<Group id="135" groupID="20"/>
	</SecurityGroups>
	<Events>
		<Event name="BeforeOutput" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="136"/>
			</Actions>
		</Event>
	</Events>
	<CachingParameters/>
	<Attributes/>
	<Features/>
</Page>

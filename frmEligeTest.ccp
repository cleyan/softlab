<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" wizardTheme="InLine" wizardThemeType="File" needGeneration="0" cachingEnabled="False" cachingDuration="1 minutes" isService="False">
	<Components>
		<Record id="19" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="All" debugMode="False" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="test_secciones_equiposSearch" wizardCaption="Buscar Test, Secciones, Equipos " wizardTheme="Inline" wizardThemeType="File" wizardOrientation="Vertical" wizardFormMethod="post" returnPage="frmEligeTest.ccp" PathID="test_secciones_equiposSearch">
			<Components>
				<TextBox id="21" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="s_test" wizardCaption="Cod Test" wizardTheme="Inline" wizardThemeType="File" wizardSize="30" wizardMaxLength="30" wizardIsPassword="False" visible="Yes" PathID="test_secciones_equiposSearchs_test">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Button id="20" urlType="Relative" enableValidation="True" isDefault="True" name="Button_DoSearch" operation="Search" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Buscar" PathID="test_secciones_equiposSearchButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Label id="59" fieldSourceType="DBColumn" dataType="Text" html="True" editable="False" name="lbl_hideseccion" wizardTheme="Inline" wizardThemeType="File">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<ListBox id="24" fieldSourceType="DBColumn" sourceType="Table" dataType="Integer" editable="True" hasErrorCollection="True" returnValueType="Number" name="s_secciones_id" wizardCaption="Secciones Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardEmptyCaption="Seleccionar Valor" connection="Datos" dataSource="secciones" boundColumn="seccion_id" textColumn="nom_seccion" visible="Yes" PathID="test_secciones_equiposSearchs_secciones_id">
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
				<Label id="54" fieldSourceType="DBColumn" dataType="Text" html="True" editable="False" name="nombre_seccion" wizardTheme="Inline" wizardThemeType="File">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<ListBox id="25" fieldSourceType="DBColumn" sourceType="Table" dataType="Integer" editable="True" hasErrorCollection="True" returnValueType="Number" name="s_test_equipo_id" wizardCaption="Test Equipo Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardEmptyCaption="Seleccionar Valor" connection="Datos" dataSource="equipos" boundColumn="equipo_id" textColumn="nom_equipo" visible="Yes" PathID="test_secciones_equiposSearchs_test_equipo_id">
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
			</Components>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="57"/>
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
		<Grid id="2" secured="False" sourceType="Table" returnValueType="Number" connection="Datos" name="test_secciones_equipos" dataSource="test, secciones, equipos" wizardCaption="Lista de Test, Secciones, Equipos " wizardTheme="Inline" wizardThemeType="File" wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAllowInsert="False" wizardAltRecord="True" wizardRecordSeparator="False" activeCollection="TableParameters" activeTableType="dataSource" defaultPageSize="10" pageSizeLimit="100" wizardUsePageScroller="True" PathID="test_secciones_equipos">
			<Components>
				<Sorter id="32" visible="True" name="Sorter_cod_test" column="cod_test" wizardCaption="Cod Test" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="cod_test" PathID="test_secciones_equiposSorter_cod_test">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="33" visible="True" name="Sorter_nom_test" column="nom_test" wizardCaption="Nom Test" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="nom_test" PathID="test_secciones_equiposSorter_nom_test">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="34" visible="True" name="Sorter_codigo_fonasa" column="codigo_fonasa" wizardCaption="Codigo Fonasa" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="codigo_fonasa" PathID="test_secciones_equiposSorter_codigo_fonasa">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="35" visible="True" name="Sorter_nom_seccion" column="nom_seccion" wizardCaption="Nom Seccion" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="nom_seccion" PathID="test_secciones_equiposSorter_nom_seccion">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="36" visible="True" name="Sorter_nom_equipo" column="nom_equipo" wizardCaption="Nom Equipo" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="nom_equipo" PathID="test_secciones_equiposSorter_nom_equipo">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Label id="48" fieldSourceType="DBColumn" dataType="Text" html="True" editable="False" name="lblOp" wizardTheme="Inline" wizardThemeType="File">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="37" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="cod_test" fieldSource="cod_test" wizardCaption="Cod Test" wizardTheme="Inline" wizardThemeType="File" wizardSize="30" wizardMaxLength="30" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="50" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="test_id" wizardTheme="Inline" wizardThemeType="File" fieldSource="test_id" PathID="test_secciones_equipostest_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="38" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nom_test" fieldSource="nom_test" wizardCaption="Nom Test" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="39" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="codigo_fonasa" fieldSource="codigo_fonasa" wizardCaption="Codigo Fonasa" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="40" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nom_seccion" fieldSource="nom_seccion" wizardCaption="Nom Seccion" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="41" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nom_equipo" fieldSource="nom_equipo" wizardCaption="Nom Equipo" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="49" fieldSourceType="DBColumn" dataType="Text" html="True" editable="False" name="Alt_lblOp" wizardTheme="Inline" wizardThemeType="File">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="42" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="Alt_cod_test" fieldSource="cod_test" wizardCaption="Cod Test" wizardTheme="Inline" wizardThemeType="File" wizardSize="30" wizardMaxLength="30" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="51" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="Alt_test_id" wizardTheme="Inline" wizardThemeType="File" fieldSource="test_id" PathID="test_secciones_equiposAlt_test_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="43" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="Alt_nom_test" fieldSource="nom_test" wizardCaption="Nom Test" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="44" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="Alt_codigo_fonasa" fieldSource="codigo_fonasa" wizardCaption="Codigo Fonasa" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="45" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="Alt_nom_seccion" fieldSource="nom_seccion" wizardCaption="Nom Seccion" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="46" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="Alt_nom_equipo" fieldSource="nom_equipo" wizardCaption="Nom Equipo" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="60" type="Simple" name="Navigator1" wizardPagingType="Custom" wizardPageNumbers="Simple" wizardTotalPages="True" wizardImages="True" wizardHideDisabled="True" wizardFirst="True" wizardPrev="True" wizardNext="True" wizardLast="True" wizardFirstText="Inicio" wizardPrevText="Anterior" wizardNextText="Siguiente" wizardLastText="Final" wizardOfText="de" wizardTheme="InLine" wizardThemeType="File" wizardImagesScheme="Square" size="10" pageSizes="1;5;10;25;50" PathID="test_secciones_equiposNavigator1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
			</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="58"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="27" conditionType="Parameter" useIsNull="False" field="cod_test" parameterSource="s_test" dataType="Text" logicOperator="Or" searchConditionType="Contains" parameterType="URL" orderNumber="1" leftBrackets="1"/>
				<TableParameter id="28" conditionType="Parameter" useIsNull="False" field="nom_test" parameterSource="s_test" dataType="Text" logicOperator="Or" searchConditionType="Contains" parameterType="URL" orderNumber="2" rightBrackets="0"/>
				<TableParameter id="29" conditionType="Parameter" useIsNull="False" field="codigo_fonasa" parameterSource="s_test" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="3" rightBrackets="1"/>
				<TableParameter id="30" conditionType="Parameter" useIsNull="False" field="secciones_id" parameterSource="s_secciones_id" dataType="Integer" logicOperator="Or" searchConditionType="Equal" parameterType="URL" orderNumber="4" leftBrackets="1"/>
				<TableParameter id="56" conditionType="Parameter" useIsNull="False" field="test.secciones_id" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="seccion_id" orderNumber="6" rightBrackets="1"/>
				<TableParameter id="31" conditionType="Parameter" useIsNull="False" field="test.equipo_id" parameterSource="s_test_equipo_id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="5"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="3" tableName="test" posWidth="190" posHeight="341" posLeft="10" posTop="10"/>
				<JoinTable id="11" tableName="secciones" posWidth="100" posHeight="107" posLeft="342" posTop="4"/>
				<JoinTable id="14" tableName="equipos" posWidth="137" posHeight="116" posLeft="271" posTop="144"/>
			</JoinTables>
			<JoinLinks>
				<JoinTable2 id="17" fieldLeft="test.equipo_id" fieldRight="equipos.equipo_id" tableLeft="test" tableRight="equipos" conditionType="Equal" joinType="left"/>
				<JoinTable2 id="18" fieldLeft="test.secciones_id" fieldRight="secciones.seccion_id" tableLeft="test" tableRight="secciones" conditionType="Equal" joinType="left"/>
			</JoinLinks>
			<Fields>
				<Field id="4" tableName="test" fieldName="test_id"/>
				<Field id="5" tableName="test" fieldName="secciones_id"/>
				<Field id="6" tableName="test" alias="test_equipo_id" fieldName="test.equipo_id"/>
				<Field id="7" tableName="test" fieldName="codigo_fonasa"/>
				<Field id="8" tableName="test" fieldName="cod_test"/>
				<Field id="9" tableName="test" fieldName="nom_test"/>
				<Field id="10" tableName="test" fieldName="orden_peticion"/>
				<Field id="12" tableName="secciones" fieldName="nom_seccion"/>
				<Field id="13" tableName="secciones" alias="secciones_activo" fieldName="secciones.activo"/>
				<Field id="15" tableName="equipos" fieldName="nom_equipo"/>
				<Field id="16" tableName="equipos" alias="equipos_activo" fieldName="equipos.activo"/>
			</Fields>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
			<PKFields/>
		</Grid>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="frmEligeTest.php" comment="//" codePage="utf-8" forShow="True" url="frmEligeTest.php"/>
		<CodeFile id="Events" language="PHPTemplates" forShow="False" name="frmEligeTest_events.php" codePage="utf-8" comment="//"/>
	</CodeFiles>
	<SecurityGroups/>
	<Events>
		<Event name="BeforeOutput" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="61"/>
			</Actions>
		</Event>
	</Events>
	<CachingParameters/>
	<Attributes/>
	<Features/>
</Page>

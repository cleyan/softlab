<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" wizardTheme="InLine" wizardThemeType="File" needGeneration="0" cachingEnabled="False" cachingDuration="1 minutes" isService="False">
	<Components>
		<Record id="21" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" debugMode="False" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="testSearch" wizardCaption="Buscar  " wizardTheme="Inline" wizardThemeType="File" wizardOrientation="Vertical" wizardFormMethod="post" returnPage="list_orden_test.ccp" PathID="testSearch">
			<Components>
				<ListBox id="25" fieldSourceType="DBColumn" sourceType="Table" dataType="Integer" editable="True" hasErrorCollection="True" returnValueType="Number" name="s_secciones_id" wizardCaption="Secciones Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardEmptyCaption="Seleccionar Valor" connection="Datos" dataSource="secciones" boundColumn="seccion_id" textColumn="nom_seccion" visible="Yes" PathID="testSearchs_secciones_id">
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
				<ListBox id="26" fieldSourceType="DBColumn" sourceType="SQL" dataType="Integer" editable="True" hasErrorCollection="True" returnValueType="Number" name="s_grupo_id" wizardCaption="Informe Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardEmptyCaption="Seleccionar Valor" connection="Datos" dataSource="SELECT grupo_id, concat(nom_informe,' - ', nom_grupo) nom_inf_grp, informes.informe_id AS informes_informe_id 
FROM grupos RIGHT JOIN informes ON
grupos.informe_id = informes.informe_id
ORDER BY nom_informe, orden, nom_grupo" orderBy="nom_informe, orden, nom_grupo" boundColumn="grupo_id" textColumn="nom_inf_grp" visible="Yes" PathID="testSearchs_grupo_id">
					<Components/>
					<Events/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="27" tableName="grupos" posWidth="100" posHeight="217" posLeft="186" posTop="23"/>
						<JoinTable id="30" tableName="informes" posWidth="131" posHeight="206" posLeft="10" posTop="10"/>
					</JoinTables>
					<JoinLinks>
						<JoinTable2 id="33" fieldLeft="grupos.informe_id" fieldRight="informes.informe_id" tableLeft="grupos" tableRight="informes" conditionType="Equal" joinType="right"/>
					</JoinLinks>
					<Fields>
						<Field id="28" tableName="grupos" fieldName="grupo_id"/>
						<Field id="29" tableName="grupos" fieldName="nom_grupo"/>
						<Field id="31" tableName="informes" alias="informes_informe_id" fieldName="informes.informe_id"/>
						<Field id="32" tableName="informes" fieldName="nom_informe"/>
					</Fields>
					<Attributes/>
					<Features/>
					<PKFields/>
				</ListBox>
				<Button id="22" urlType="Relative" enableValidation="True" isDefault="True" name="Button_DoSearch" operation="Search" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Buscar" PathID="testSearchButton_DoSearch">
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
		<Grid id="2" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="15" name="test" connection="Datos" dataSource="test, grupos_detalle" pageSizeLimit="100" wizardCaption="Lista de Test " wizardTheme="Inline" wizardThemeType="File" wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAllowInsert="False" wizardAltRecord="False" wizardRecordSeparator="False" wizardUsePageScroller="True" activeCollection="TableParameters" activeTableType="dataSource" PathID="test">
			<Components>
				<Sorter id="11" visible="True" name="Sorter_cod_test" column="cod_test" wizardCaption="Cod Test" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="cod_test" PathID="testSorter_cod_test">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="12" visible="True" name="Sorter_nom_test" column="nom_test" wizardCaption="Nom Test" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="nom_test" PathID="testSorter_nom_test">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="13" visible="True" name="Sorter_orden_peticion" column="orden_peticion" wizardCaption="Orden Peticion" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="orden_peticion" PathID="testSorter_orden_peticion">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="14" visible="True" name="Sorter_orden_informe" column="orden_informe" wizardCaption="Orden Informe" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="orden_informe" PathID="testSorter_orden_informe">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Label id="15" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="cod_test" fieldSource="cod_test" wizardCaption="Cod Test" wizardTheme="Inline" wizardThemeType="File" wizardSize="30" wizardMaxLength="30" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="16" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nom_test" fieldSource="nom_test" wizardCaption="Nom Test" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="17" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="False" name="orden_peticion" fieldSource="orden_peticion" wizardCaption="Orden Peticion" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="18" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="False" name="orden_informe" fieldSource="orden_informe" wizardCaption="Orden Informe" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="20" type="Simple" name="Navigator1" wizardPagingType="Custom" wizardPageNumbers="Simple" wizardTotalPages="True" wizardImages="True" wizardHideDisabled="False" wizardFirst="True" wizardPrev="True" wizardNext="True" wizardLast="True" wizardFirstText="Inicio" wizardPrevText="Anterior" wizardNextText="Siguiente" wizardLastText="Final" wizardOfText="de" wizardTheme="InLine" wizardThemeType="File" wizardImagesScheme="Square" size="10" pageSizes="1;5;10;25;50" PathID="testNavigator1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="23" conditionType="Parameter" useIsNull="False" field="secciones_id" parameterSource="s_secciones_id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1"/>
				<TableParameter id="24" conditionType="Parameter" useIsNull="False" field="grupos_detalle.grupo_id" parameterSource="s_grupo_id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="2"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="34" tableName="test" posWidth="147" posHeight="446" posLeft="10" posTop="10"/>
				<JoinTable id="36" tableName="grupos_detalle" posWidth="100" posHeight="246" posLeft="237" posTop="9"/>
			</JoinTables>
			<JoinLinks>
				<JoinTable2 id="38" fieldLeft="grupos_detalle.test_id" fieldRight="test.test_id" tableLeft="grupos_detalle" tableRight="test" conditionType="Equal" joinType="right"/>
			</JoinLinks>
			<Fields>
				<Field id="35" tableName="test" fieldName="test.*"/>
				<Field id="37" tableName="grupos_detalle" fieldName="grupo_id"/>
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
		<CodeFile id="Code" language="PHPTemplates" name="list_orden_test.php" comment="//" codePage="utf-8" forShow="True" url="list_orden_test.php"/>
		<CodeFile id="Events" language="PHPTemplates" name="list_orden_test_events.php" forShow="False" comment="//" codePage="utf-8"/>
	</CodeFiles>
	<SecurityGroups/>
	<Events>
		<Event name="BeforeOutput" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="39"/>
			</Actions>
		</Event>
	</Events>
	<CachingParameters/>
	<Attributes/>
	<Features/>
</Page>

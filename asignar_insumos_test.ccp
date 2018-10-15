<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" wizardTheme="InLine" wizardThemeType="File" needGeneration="0" cachingEnabled="False" cachingDuration="1 minutes" isService="False">
	<Components>
		<EditableGrid id="2" urlType="Relative" secured="False" emptyRows="30" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" sourceType="Table" defaultPageSize="100" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="Datos" dataSource="insumos_x_test" name="insumos_x_test" pageSizeLimit="100" wizardCaption="Lista de Insumos X Test " wizardTheme="Inline" wizardThemeType="File" wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAltRecord="False" wizardRecordSeparator="False" deleteControl="CheckBox_Delete" activeCollection="UConditions" activeTableType="customUpdate" customInsertType="Table" customInsert="insumos_x_test" PathID="insumos_x_test">
			<Components>
				<Label id="60" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nom_test" wizardTheme="Inline" wizardThemeType="File">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="61"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="6" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="insumos_x_test_TotalRecords" wizardTheme="Inline" wizardThemeType="File" wizardUseTemplateBlock="False">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Retrieve number of records" actionCategory="Database" id="7"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Sorter id="9" visible="True" name="Sorter_insumo_id" column="insumo_id" wizardCaption="Insumo Id" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="insumo_id" PathID="insumos_x_testSorter_insumo_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="11" visible="True" name="Sorter_cantidad_x_test" column="cantidad_x_test" wizardCaption="Cantidad X Test" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="cantidad_x_test" PathID="insumos_x_testSorter_cantidad_x_test">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Label id="65" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="RowIDAttribute" wizardTheme="Inline" wizardThemeType="File">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="66" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="RowNameAttribute" wizardTheme="Inline" wizardThemeType="File">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="63" fieldSourceType="DBColumn" dataType="Text" html="True" editable="False" name="RowStyleAttribute" wizardTheme="Inline" wizardThemeType="File">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<TextBox id="51" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="nom_insumo" wizardTheme="Inline" wizardThemeType="File" visible="Yes" PathID="insumos_x_testnom_insumo">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="52" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="last_insumo_id" wizardTheme="Inline" wizardThemeType="File" visible="Yes" PathID="insumos_x_testlast_insumo_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="15" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="insumo_id" fieldSource="insumo_id" required="True" caption="Insumo" wizardCaption="Insumo Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" sourceType="Table" connection="Datos" dataSource="insumos" boundColumn="insumo_id" textColumn="nom_insumo" activeCollection="TableParameters" activeTableType="dataSource" orderBy="nom_insumo" visible="Yes" PathID="insumos_x_testinsumo_id">
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
				<Hidden id="14" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="test_id" fieldSource="test_id" required="False" caption="Test Id" wizardCaption="Test Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="insumos_x_testtest_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="17" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="cantidad_x_test" fieldSource="cantidad_x_test" caption="Cantidad X Test" wizardCaption="Cantidad X Test" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" required="False" visible="Yes" PathID="insumos_x_testcantidad_x_test">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<CheckBox id="20" fieldSourceType="CodeExpression" dataType="Boolean" editable="True" name="CheckBox_Delete" checkedValue="true" uncheckedValue="false" wizardCaption="Borrar" wizardTheme="Inline" wizardThemeType="File" wizardUseTemplateBlock="True" visible="Yes" PathID="insumos_x_testCheckBox_Delete" defaultValue="Unchecked">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</CheckBox>
				<Navigator id="21" type="Centered" name="Navigator" size="10" wizardPagingType="Centered" wizardFirst="True" wizardFirstText="Inicio" wizardPrev="True" wizardPrevText="Anterior" wizardNext="True" wizardNextText="Siguiente" wizardLast="True" wizardLastText="Final" wizardImages="False" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="False" wizardTheme="Inline" wizardThemeType="File" wizardImagesScheme="Inline" pageSizes="1;5;10;25;50" PathID="insumos_x_testNavigator">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Button id="62" urlType="Relative" enableValidation="False" isDefault="False" name="AddRowBtn" wizardTheme="Inline" wizardThemeType="File" PathID="insumos_x_testAddRowBtn">
					<Components/>
					<Events>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="67"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="22" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Submit" operation="Submit" wizardCaption="Grabar" wizardTheme="Inline" wizardThemeType="File" returnPage="list_test.ccp" PathID="insumos_x_testButton_Submit">
					<Components/>
					<Events>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Confirmation Message" actionCategory="General" id="23" message="Recuerde que sólo se guardaran los cambios en los registros que esten con toda la informació solicitada. ¿Desea guardar los cambios?"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="24" urlType="Relative" enableValidation="False" isDefault="False" name="Cancel" operation="Cancel" wizardCaption="Cancelar" wizardTheme="Inline" wizardThemeType="File" returnPage="list_test.ccp" removeParameters="test_id" PathID="insumos_x_testCancel">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
			</Components>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="68"/>
					</Actions>
				</Event>
				<Event name="BeforeSubmit" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="69"/>
					</Actions>
				</Event>
				<Event name="BeforeExecuteDelete" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="70"/>
					</Actions>
				</Event>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="71"/>
					</Actions>
				</Event>
				<Event name="OnValidate" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="72"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="25" conditionType="Parameter" useIsNull="False" field="test_id" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="test_id" orderNumber="1"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables>
				<JoinTable id="47" tableName="insumos_x_test" posWidth="170" posHeight="178" posLeft="495" posTop="212"/>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="48" tableName="insumos_x_test" fieldName="*"/>
			</Fields>
			<PKFields>
				<PKField id="49" tableName="insumos_x_test" fieldName="insumo_x_test_id" dataType="Integer"/>
			</PKFields>
			<ISPParameters/>
			<ISQLParameters>
				<SQLParameter id="73" variable="insumo_id" dataType="Integer" parameterType="Control" parameterSource="insumo_id"/>
				<SQLParameter id="74" variable="test_id" dataType="Integer" parameterType="Control" parameterSource="test_id"/>
				<SQLParameter id="75" variable="cantidad_x_test" dataType="Integer" parameterType="Control" parameterSource="cantidad_x_test"/>
				<SQLParameter id="76" variable="unidad_medida" dataType="Text" parameterType="Control" parameterSource="unidad_medida"/>
				<SQLParameter id="77" variable="costo" dataType="Integer" parameterType="Control" parameterSource="costo"/>
			</ISQLParameters>
			<IFormElements>
				<CustomParameter id="55" field="insumo_id" dataType="Integer" parameterType="Control" parameterSource="insumo_id"/>
				<CustomParameter id="56" field="test_id" dataType="Integer" parameterType="Expression" parameterSource="CCGetParam('test_id')"/><CustomParameter id="57" field="cantidad_x_test" dataType="Integer" parameterType="Control" parameterSource="cantidad_x_test"/><CustomParameter id="58" field="unidad_medida" dataType="Text" parameterType="Control" parameterSource="unidad_medida"/>
				<CustomParameter id="59" field="costo" dataType="Integer" parameterType="Control" parameterSource="costo"/>
			</IFormElements>
			<USPParameters/>
			<USQLParameters/>
			<UConditions>
				<TableParameter id="78" conditionType="Parameter" useIsNull="False" field="insumo_x_test_id" dataType="Integer" parameterType="DataSourceColumn" parameterSource="insumo_x_test_id" searchConditionType="Equal" logicOperator="And"/>
			</UConditions>
			<UFormElements>
				<CustomParameter id="82" field="insumo_id" dataType="Integer" parameterType="Control" parameterSource="insumo_id"/>
				<CustomParameter id="83" field="test_id" dataType="Integer" parameterType="Control" parameterSource="test_id"/>
				<CustomParameter id="84" field="cantidad_x_test" dataType="Integer" parameterType="Control" parameterSource="cantidad_x_test"/>
			</UFormElements>
			<DSPParameters/>
			<DSQLParameters/>
			<DConditions>
				<TableParameter id="88" conditionType="Parameter" useIsNull="False" field="insumo_x_test_id" dataType="Integer" parameterType="DataSourceColumn" parameterSource="insumo_x_test_id" searchConditionType="Equal"/>
				<TableParameter id="89" conditionType="Parameter" useIsNull="False" field="test_id" dataType="Integer" parameterType="URL" parameterSource="test_id" searchConditionType="Equal" logicOperator="And" orderNumber="1"/>
			</DConditions>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</EditableGrid>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="asignar_insumos_test_events.php" comment="//" codePage="utf-8" forShow="False"/>
		<CodeFile id="Code" language="PHPTemplates" name="asignar_insumos_test.php" comment="//" codePage="utf-8" forShow="True" url="asignar_insumos_test.php"/>
	</CodeFiles>
	<SecurityGroups/>
	<Events>
		<Event name="BeforeOutput" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="90"/>
			</Actions>
		</Event>
	</Events>
	<CachingParameters/>
	<Attributes/>
	<Features/>
</Page>

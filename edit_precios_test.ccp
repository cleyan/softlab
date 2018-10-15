<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" wizardTheme="InLine" wizardThemeType="File" needGeneration="0" accessDeniedPage="error_nivel.ccp" cachingEnabled="False" cachingDuration="1 minutes" isService="False">
	<Components>
		<Record id="12" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" debugMode="False" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="precios_test_testSearch" wizardCaption="Buscar Precios Test, Test " wizardTheme="Inline" wizardThemeType="File" wizardOrientation="Vertical" wizardFormMethod="post" returnPage="edit_precios_test.ccp" PathID="precios_test_testSearch">
			<Components>
				<TextBox id="15" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="s_codigo_fonasa" wizardCaption="Codigo Fonasa" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" visible="Yes" PathID="precios_test_testSearchs_codigo_fonasa">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="16" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="s_cod_test" wizardCaption="Cod Test" wizardTheme="Inline" wizardThemeType="File" wizardSize="30" wizardMaxLength="30" wizardIsPassword="False" visible="Yes" PathID="precios_test_testSearchs_cod_test">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="14" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="s_prevision_id" wizardCaption="Prevision Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" sourceType="Table" connection="Datos" dataSource="previsiones" boundColumn="prevision_id" textColumn="nom_prevision" visible="Yes" PathID="precios_test_testSearchs_prevision_id">
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
				<ListBox id="111" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" editable="True" hasErrorCollection="True" returnValueType="Number" name="s_procedencia_id" wizardTheme="Inline" wizardThemeType="File" wizardEmptyCaption="Seleccionar Valor" connection="Datos" dataSource="procedencias" activeCollection="TableParameters" activeTableType="dataSource" orderBy="nom_procedencia" boundColumn="procedencia_id" textColumn="nom_procedencia" visible="Yes" PathID="precios_test_testSearchs_procedencia_id">
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
				<TextBox id="17" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="s_nom_test" wizardCaption="Nom Test" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" visible="Yes" PathID="precios_test_testSearchs_nom_test">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="18" fieldSourceType="DBColumn" sourceType="ListOfValues" dataType="Text" editable="True" hasErrorCollection="True" returnValueType="Number" name="precios_test_testPageSize" dataSource=";Seleccionar Valor;5;5;10;10;25;25;100;100" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Registro por página" wizardNoEmptyValue="True" visible="Yes" PathID="precios_test_testSearchprecios_test_testPageSize">
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
				<Button id="13" urlType="Relative" enableValidation="True" isDefault="True" name="Button_DoSearch" operation="Search" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Buscar" PathID="precios_test_testSearchButton_DoSearch">
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
		<EditableGrid id="2" urlType="Relative" secured="False" emptyRows="0" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" sourceType="Table" defaultPageSize="10" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="Datos" name="precios_test_test" dataSource="precios_test, test, previsiones, procedencias" pageSizeLimit="100" wizardCaption="Lista de Precios Test, Test " wizardTheme="Inline" wizardThemeType="File" wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAltRecord="False" wizardRecordSeparator="False" deleteControl="CheckBox_Delete" customInsertType="Table" customInsert="precios_test" customUpdateType="Table" customUpdate="precios_test" customDeleteType="Table" customDelete="precios_test" wizardAllowSorting="True" orderBy="codigo_fonasa, cod_test, nom_test, nom_prevision" activeCollection="TableParameters" activeTableType="dataSource" PathID="precios_test_test">
			<Components>
				<Label id="20" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="precios_test_test_TotalRecords" wizardTheme="Inline" wizardThemeType="File" wizardUseTemplateBlock="False">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Retrieve number of records" actionCategory="Database" id="21"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Sorter id="26" visible="True" name="Sorter_codigo_fonasa" column="codigo_fonasa" wizardCaption="Codigo Fonasa" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="codigo_fonasa" PathID="precios_test_testSorter_codigo_fonasa">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="28" visible="True" name="Sorter_nom_test" column="nom_test" wizardCaption="Nom Test" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="nom_test" connection="Datos" PathID="precios_test_testSorter_nom_test">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="74" visible="True" name="Sorter_nom_procedencia" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="Simple" connection="Datos" column="nom_procedencia" PathID="precios_test_testSorter_nom_procedencia">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="59" visible="True" name="Sorter_nom_prevision" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" column="nom_prevision" PathID="precios_test_testSorter_nom_prevision">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="31" visible="True" name="Sorter_precio" column="precio" wizardCaption="Precio" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="precio" PathID="precios_test_testSorter_precio">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Label id="33" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="codigo_fonasa" fieldSource="codigo_fonasa" required="False" caption="Codigo Fonasa" wizardCaption="Codigo Fonasa" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="36" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="test_id" fieldSource="test_id" required="False" caption="Test Id" wizardCaption="Test Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" sourceType="Table" connection="Datos" dataSource="test" boundColumn="test_id" textColumn="nom_test" PathID="precios_test_testtest_id">
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
				</Hidden>
				<Hidden id="37" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="prevision_id" fieldSource="prevision_id" required="False" caption="Prevision Id" wizardCaption="Prevision Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" sourceType="Table" connection="Datos" dataSource="previsiones" boundColumn="prevision_id" textColumn="nom_prevision" PathID="precios_test_testprevision_id">
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
				</Hidden>
				<Hidden id="39" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="precio_test_id" fieldSource="precio_test_id" required="False" caption="Precio Test Id" wizardCaption="Precio Test Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="precios_test_testprecio_test_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="35" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="nom_test" fieldSource="nom_test" required="False" caption="Nom Test" wizardCaption="Nom Test" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="75" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nom_procedencia" wizardTheme="Inline" wizardThemeType="File" fieldSource="nom_procedencia">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="60" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nom_prevision" wizardTheme="Inline" wizardThemeType="File" fieldSource="nom_prevision">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<TextBox id="38" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="precio" fieldSource="precio" required="False" caption="Precio" wizardCaption="Precio" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" visible="Yes" PathID="precios_test_testprecio">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<CheckBox id="40" fieldSourceType="CodeExpression" dataType="Boolean" editable="True" name="CheckBox_Delete" checkedValue="true" uncheckedValue="false" wizardCaption="Borrar" wizardTheme="Inline" wizardThemeType="File" wizardUseTemplateBlock="True" visible="Yes" PathID="precios_test_testCheckBox_Delete" defaultValue="Unchecked">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</CheckBox>
				<Navigator id="41" type="Centered" name="Navigator" size="10" wizardPagingType="Centered" wizardFirst="True" wizardFirstText="Inicio" wizardPrev="True" wizardPrevText="Anterior" wizardNext="True" wizardNextText="Siguiente" wizardLast="True" wizardLastText="Final" wizardImages="False" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="False" wizardTheme="Inline" wizardThemeType="File" wizardImagesScheme="Inline" pageSizes="1;5;10;25;50" PathID="precios_test_testNavigator">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Button id="42" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Submit" operation="Submit" wizardCaption="Grabar" wizardTheme="Inline" wizardThemeType="File" PathID="precios_test_testButton_Submit">
					<Components/>
					<Events>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Confirmation Message" actionCategory="General" id="43" message="¿Guardar los cambios?"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="44" urlType="Relative" enableValidation="False" isDefault="False" name="Cancel" operation="Cancel" wizardCaption="Cancelar" wizardTheme="Inline" wizardThemeType="File" PathID="precios_test_testCancel">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="22" conditionType="Parameter" useIsNull="False" field="precios_test.prevision_id" parameterSource="s_prevision_id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1"/>
				<TableParameter id="23" conditionType="Parameter" useIsNull="False" field="codigo_fonasa" parameterSource="s_codigo_fonasa" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="2"/>
				<TableParameter id="24" conditionType="Parameter" useIsNull="False" field="cod_test" parameterSource="s_cod_test" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="3"/>
				<TableParameter id="25" conditionType="Parameter" useIsNull="False" field="nom_test" parameterSource="s_nom_test" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="4"/>
				<TableParameter id="110" conditionType="Parameter" useIsNull="False" field="precios_test.procedencia_id" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="s_procedencia_id" orderNumber="5"/>
				<TableParameter id="112" conditionType="Parameter" useIsNull="False" field="test.aislado" dataType="Text" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="'V'" orderNumber="6"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables>
				<JoinTable id="93" tableName="precios_test" posWidth="155" posHeight="220" posLeft="10" posTop="10"/>
				<JoinTable id="96" tableName="test" posWidth="320" posHeight="504" posLeft="524" posTop="21"/>
				<JoinTable id="101" tableName="previsiones" posWidth="146" posHeight="121" posLeft="122" posTop="383"/>
				<JoinTable id="104" tableName="procedencias" posWidth="183" posHeight="157" posLeft="203" posTop="110"/>
			</JoinTables>
			<JoinLinks>
				<JoinTable2 id="107" fieldLeft="precios_test.test_id" fieldRight="test.test_id" tableLeft="precios_test" tableRight="test" conditionType="Equal" joinType="left"/>
				<JoinTable2 id="108" fieldLeft="precios_test.prevision_id" fieldRight="previsiones.prevision_id" tableLeft="precios_test" tableRight="previsiones" conditionType="Equal" joinType="left"/>
				<JoinTable2 id="109" fieldLeft="precios_test.procedencia_id" fieldRight="procedencias.procedencia_id" tableLeft="precios_test" tableRight="procedencias" conditionType="Equal" joinType="left"/>
			</JoinLinks>
			<Fields>
				<Field id="94" tableName="precios_test" fieldName="precios_test.*"/>
				<Field id="98" tableName="test" fieldName="codigo_fonasa"/>
				<Field id="99" tableName="test" fieldName="cod_test"/>
				<Field id="100" tableName="test" fieldName="nom_test"/>
				<Field id="103" tableName="previsiones" fieldName="nom_prevision"/>
				<Field id="106" tableName="procedencias" fieldName="nom_procedencia"/>
			</Fields>
			<PKFields/>
			<ISPParameters/>
			<ISQLParameters/>
			<IFormElements>
				<CustomParameter id="45" field="test_id" dataType="Integer" parameterType="Control" parameterSource="test_id"/>
				<CustomParameter id="46" field="prevision_id" dataType="Integer" parameterType="Control" parameterSource="prevision_id"/>
				<CustomParameter id="47" field="precio" dataType="Integer" parameterType="Control" parameterSource="precio"/>
				<CustomParameter id="48" field="precio_test_id" dataType="Integer" parameterType="Control" parameterSource="precio_test_id"/>
			</IFormElements>
			<USPParameters/>
			<USQLParameters/>
			<UConditions>
				<TableParameter id="49" conditionType="Parameter" useIsNull="False" field="precio_test_id" dataType="Integer" parameterType="DataSourceColumn" parameterSource="precio_test_id" searchConditionType="Equal"/>
			</UConditions>
			<UFormElements>
				<CustomParameter id="54" field="test_id" dataType="Integer" parameterType="Control" parameterSource="test_id"/>
				<CustomParameter id="55" field="prevision_id" dataType="Integer" parameterType="Control" parameterSource="prevision_id"/>
				<CustomParameter id="56" field="precio" dataType="Integer" parameterType="Control" parameterSource="precio"/>
				<CustomParameter id="57" field="precio_test_id" dataType="Integer" parameterType="Control" parameterSource="precio_test_id"/>
			</UFormElements>
			<DSPParameters/>
			<DSQLParameters/>
			<DConditions>
				<TableParameter id="58" conditionType="Parameter" useIsNull="False" field="precio_test_id" dataType="Integer" parameterType="DataSourceColumn" parameterSource="precio_test_id" searchConditionType="Equal"/>
			</DConditions>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</EditableGrid>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="edit_precios_test.php" comment="//" codePage="utf-8" forShow="True" url="edit_precios_test.php"/>
		<CodeFile id="Events" language="PHPTemplates" forShow="False" name="edit_precios_test_events.php" codePage="utf-8" comment="//"/>
	</CodeFiles>
	<SecurityGroups>
		<Group id="113" groupID="16"/>
		<Group id="114" groupID="17"/>
		<Group id="115" groupID="18"/>
		<Group id="116" groupID="19"/>
		<Group id="117" groupID="20"/>
	</SecurityGroups>
	<Events>
		<Event name="BeforeOutput" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="118"/>
			</Actions>
		</Event>
	</Events>
	<CachingParameters/>
	<Attributes/>
	<Features/>
</Page>

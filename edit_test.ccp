<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" wizardTheme="InLine" wizardThemeType="File" needGeneration="0" accessDeniedPage="error_nivel.ccp" cachingEnabled="False" cachingDuration="1 minutes" isService="False">
	<Components>
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" debugMode="False" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="testSearch" wizardCaption="Buscar Test " wizardTheme="Inline" wizardThemeType="File" wizardOrientation="Vertical" wizardFormMethod="post" returnPage="edit_test.ccp" PathID="testSearch">
			<Components>
				<TextBox id="5" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="s_secciones_id" wizardCaption="Secciones Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" visible="Yes" PathID="testSearchs_secciones_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="6" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="s_equipo_id" wizardCaption="Equipo Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" visible="Yes" PathID="testSearchs_equipo_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="7" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="s_tipo_muestra_id" wizardCaption="Tipo Muestra Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" visible="Yes" PathID="testSearchs_tipo_muestra_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="8" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="s_codigo_fonasa" wizardCaption="Codigo Fonasa" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" visible="Yes" PathID="testSearchs_codigo_fonasa">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="9" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="s_cod_test" wizardCaption="Cod Test" wizardTheme="Inline" wizardThemeType="File" wizardSize="30" wizardMaxLength="30" wizardIsPassword="False" visible="Yes" PathID="testSearchs_cod_test">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="10" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="s_nom_test" wizardCaption="Nom Test" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" visible="Yes" PathID="testSearchs_nom_test">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="True" name="Button_DoSearch" operation="Search" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Buscar" PathID="testSearchButton_DoSearch">
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
		<EditableGrid id="2" urlType="Relative" secured="False" emptyRows="0" allowInsert="False" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" sourceType="Table" defaultPageSize="10" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="test" connection="Datos" dataSource="test" pageSizeLimit="100" wizardCaption="Lista de Test " wizardTheme="Inline" wizardThemeType="File" wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAltRecord="False" wizardRecordSeparator="False" deleteControl="CheckBox_Delete" PathID="test">
			<Components>
				<Label id="12" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="test_TotalRecords" wizardTheme="Inline" wizardThemeType="File" wizardUseTemplateBlock="False">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Retrieve number of records" actionCategory="Database" id="13"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Sorter id="20" visible="True" name="Sorter_secciones_id" column="secciones_id" wizardCaption="Secciones Id" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="secciones_id" PathID="testSorter_secciones_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="21" visible="True" name="Sorter_equipo_id" column="equipo_id" wizardCaption="Equipo Id" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="equipo_id" PathID="testSorter_equipo_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="23" visible="True" name="Sorter_tipo_muestra_id" column="tipo_muestra_id" wizardCaption="Tipo Muestra Id" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="tipo_muestra_id" PathID="testSorter_tipo_muestra_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="24" visible="True" name="Sorter_codigo_fonasa" column="codigo_fonasa" wizardCaption="Codigo Fonasa" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="codigo_fonasa" PathID="testSorter_codigo_fonasa">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="25" visible="True" name="Sorter_cod_test" column="cod_test" wizardCaption="Cod Test" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="cod_test" PathID="testSorter_cod_test">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="26" visible="True" name="Sorter_nom_test" column="nom_test" wizardCaption="Nom Test" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="nom_test" PathID="testSorter_nom_test">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="27" visible="True" name="Sorter_unidad_medida" column="unidad_medida" wizardCaption="Unidad Medida" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="unidad_medida" PathID="testSorter_unidad_medida">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="28" visible="True" name="Sorter_acceso_rapido" column="acceso_rapido" wizardCaption="Acceso Rapido" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="acceso_rapido" PathID="testSorter_acceso_rapido">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="31" visible="True" name="Sorter_aislado" column="aislado" wizardCaption="Aislado" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="aislado" PathID="testSorter_aislado">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="32" visible="True" name="Sorter_compuesto" column="compuesto" wizardCaption="Compuesto" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="compuesto" PathID="testSorter_compuesto">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="33" visible="True" name="Sorter_formato_id" column="formato_id" wizardCaption="Formato Id" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="formato_id" PathID="testSorter_formato_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<ListBox id="35" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="secciones_id" fieldSource="secciones_id" required="False" caption="Secciones Id" wizardCaption="Secciones Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" sourceType="Table" connection="Datos" dataSource="secciones" boundColumn="seccion_id" textColumn="nom_seccion" visible="Yes" PathID="testsecciones_id">
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
				<ListBox id="36" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="equipo_id" fieldSource="equipo_id" required="False" caption="Equipo Id" wizardCaption="Equipo Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" sourceType="Table" connection="Datos" dataSource="equipos" boundColumn="equipo_id" textColumn="nom_equipo" visible="Yes" PathID="testequipo_id">
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
				<ListBox id="38" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="tipo_muestra_id" fieldSource="tipo_muestra_id" required="False" caption="Tipo Muestra Id" wizardCaption="Tipo Muestra Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" sourceType="Table" connection="Datos" dataSource="tipos_muestra" boundColumn="tipo_muestra_id" textColumn="nom_tipo_muestra" visible="Yes" PathID="testtipo_muestra_id">
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
				<TextBox id="39" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="codigo_fonasa" fieldSource="codigo_fonasa" required="False" caption="Codigo Fonasa" wizardCaption="Codigo Fonasa" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" visible="Yes" PathID="testcodigo_fonasa">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="40" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="cod_test" fieldSource="cod_test" required="False" caption="Cod Test" wizardCaption="Cod Test" wizardTheme="Inline" wizardThemeType="File" wizardSize="30" wizardMaxLength="30" wizardIsPassword="False" wizardUseTemplateBlock="False" visible="Yes" PathID="testcod_test">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="41" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="nom_test" fieldSource="nom_test" required="False" caption="Nom Test" wizardCaption="Nom Test" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" visible="Yes" PathID="testnom_test">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="42" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="unidad_medida" fieldSource="unidad_medida" required="False" caption="Unidad Medida" wizardCaption="Unidad Medida" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" visible="Yes" PathID="testunidad_medida">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<CheckBox id="44" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="acceso_rapido" fieldSource="acceso_rapido" required="False" caption="Acceso Rapido" wizardCaption="Acceso Rapido" wizardTheme="Inline" wizardThemeType="File" wizardSize="1" wizardMaxLength="1" wizardIsPassword="False" wizardUseTemplateBlock="False" sourceType="Table" checkedValue="'V'" visible="Yes" uncheckedValue="'F'" PathID="testacceso_rapido" defaultValue="Unchecked">
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
				</CheckBox>
				<CheckBox id="47" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="aislado" fieldSource="aislado" required="False" caption="Aislado" wizardCaption="Aislado" wizardTheme="Inline" wizardThemeType="File" wizardSize="1" wizardMaxLength="1" wizardIsPassword="False" wizardUseTemplateBlock="False" checkedValue="'V'" visible="Yes" uncheckedValue="'F'" PathID="testaislado" defaultValue="Unchecked">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</CheckBox>
				<CheckBox id="48" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="compuesto" fieldSource="compuesto" required="False" caption="Compuesto" wizardCaption="Compuesto" wizardTheme="Inline" wizardThemeType="File" wizardSize="1" wizardMaxLength="1" wizardIsPassword="False" wizardUseTemplateBlock="False" checkedValue="'V'" visible="Yes" uncheckedValue="'F'" PathID="testcompuesto" defaultValue="Unchecked">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</CheckBox>
				<ListBox id="49" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="formato_id" fieldSource="formato_id" required="False" caption="Formato Id" wizardCaption="Formato Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" sourceType="Table" connection="Datos" dataSource="formatos" boundColumn="formato_id" textColumn="nom_formato" visible="Yes" PathID="testformato_id">
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
				<CheckBox id="51" fieldSourceType="CodeExpression" dataType="Boolean" editable="True" name="CheckBox_Delete" checkedValue="true" uncheckedValue="false" wizardCaption="Borrar" wizardTheme="Inline" wizardThemeType="File" wizardUseTemplateBlock="True" visible="Yes" PathID="testCheckBox_Delete" defaultValue="Unchecked">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</CheckBox>
				<Navigator id="52" type="Centered" name="Navigator" size="10" wizardPagingType="Centered" wizardFirst="True" wizardFirstText="Inicio" wizardPrev="True" wizardPrevText="Anterior" wizardNext="True" wizardNextText="Siguiente" wizardLast="True" wizardLastText="Final" wizardImages="False" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="False" wizardTheme="Inline" wizardThemeType="File" wizardImagesScheme="Inline" pageSizes="1;5;10;25;50" PathID="testNavigator">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Button id="53" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Submit" operation="Submit" wizardCaption="Grabar" wizardTheme="Inline" wizardThemeType="File" PathID="testButton_Submit">
					<Components/>
					<Events>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Confirmation Message" actionCategory="General" id="54" message="Enviar registro?"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="55" urlType="Relative" enableValidation="False" isDefault="False" name="Cancel" operation="Cancel" wizardCaption="Cancelar" wizardTheme="Inline" wizardThemeType="File" PathID="testCancel">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="14" conditionType="Parameter" useIsNull="False" field="secciones_id" parameterSource="s_secciones_id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1"/>
				<TableParameter id="15" conditionType="Parameter" useIsNull="False" field="equipo_id" parameterSource="s_equipo_id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="2"/>
				<TableParameter id="16" conditionType="Parameter" useIsNull="False" field="tipo_muestra_id" parameterSource="s_tipo_muestra_id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="3"/>
				<TableParameter id="17" conditionType="Parameter" useIsNull="False" field="codigo_fonasa" parameterSource="s_codigo_fonasa" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="4"/>
				<TableParameter id="18" conditionType="Parameter" useIsNull="False" field="cod_test" parameterSource="s_cod_test" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="5"/>
				<TableParameter id="19" conditionType="Parameter" useIsNull="False" field="nom_test" parameterSource="s_nom_test" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="6"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<PKFields>
				<PKField id="11" tableName="test" fieldName="test_id" dataType="Integer"/>
			</PKFields>
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
		</EditableGrid>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="edit_test_events.php" comment="//" forShow="False" codePage="utf-8"/>
		<CodeFile id="Code" language="PHPTemplates" name="edit_test.php" comment="//" forShow="True" url="edit_test.php" codePage="utf-8"/>
	</CodeFiles>
	<SecurityGroups>
		<Group id="56" groupID="15"/>
		<Group id="57" groupID="16"/>
		<Group id="58" groupID="17"/>
		<Group id="59" groupID="18"/>
		<Group id="60" groupID="19"/>
		<Group id="61" groupID="20"/>
	</SecurityGroups>
	<Events>
		<Event name="BeforeOutput" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="62"/>
			</Actions>
		</Event>
	</Events>
	<CachingParameters/>
	<Attributes/>
	<Features/>
</Page>

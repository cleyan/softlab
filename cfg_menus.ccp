<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" wizardTheme="InLine" wizardThemeType="File" needGeneration="0" cachingEnabled="False" cachingDuration="1 minutes" isService="False">
	<Components>
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" debugMode="False" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="menuSearch" wizardCaption="Buscar Menu " wizardTheme="Inline" wizardThemeType="File" wizardOrientation="Vertical" wizardFormMethod="post" returnPage="cfg_menus.ccp" PathID="menuSearch">
			<Components>
				<TextBox id="5" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="s_caption" wizardCaption="Caption" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" visible="Yes" PathID="menuSearchs_caption">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="6" fieldSourceType="DBColumn" sourceType="Table" dataType="Integer" editable="True" hasErrorCollection="True" returnValueType="Number" name="s_niver_minimo_id" wizardCaption="Niver Minimo Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardEmptyCaption="Seleccionar Valor" connection="Datos" dataSource="niveles_acceso" boundColumn="nivel_acceso_id" textColumn="nom_nivel_acceso" visible="Yes" PathID="menuSearchs_niver_minimo_id">
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
				<ListBox id="7" fieldSourceType="DBColumn" sourceType="ListOfValues" dataType="Text" editable="True" hasErrorCollection="True" returnValueType="Number" name="menuPageSize" dataSource=";Seleccionar Valor;5;5;10;10;25;25;100;100" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Registro por página" wizardNoEmptyValue="True" visible="Yes" PathID="menuSearchmenuPageSize">
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
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="True" name="Button_DoSearch" operation="Search" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Buscar" PathID="menuSearchButton_DoSearch">
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
		<EditableGrid id="2" urlType="Relative" secured="False" emptyRows="1" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" sourceType="Table" defaultPageSize="10" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="menu" connection="Datos" dataSource="menu" pageSizeLimit="100" wizardCaption="Lista de Menu " wizardTheme="Inline" wizardThemeType="File" wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAltRecord="False" wizardRecordSeparator="False" deleteControl="CheckBox_Delete" activeCollection="TableParameters" activeTableType="dataSource" PathID="menu">
			<Components>
				<Sorter id="11" visible="True" name="Sorter_caption" column="caption" wizardCaption="Caption" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="caption" PathID="menuSorter_caption">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="12" visible="True" name="Sorter_icono" column="icono" wizardCaption="Icono" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="icono" PathID="menuSorter_icono">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="13" visible="True" name="Sorter_accion" column="accion" wizardCaption="Accion" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="accion" PathID="menuSorter_accion">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="14" visible="True" name="Sorter_niver_minimo_id" column="niver_minimo_id" wizardCaption="Niver Minimo Id" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="niver_minimo_id" PathID="menuSorter_niver_minimo_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<TextBox id="15" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="caption" fieldSource="caption" required="False" caption="Caption" wizardCaption="Caption" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" visible="Yes" PathID="menucaption">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<FileUpload id="24" fieldSourceType="DBColumn" allowedFileMasks="*.jpg;*.gif;*.png" fileSizeLimit="100000" dataType="Text" tempFileFolder="TEMP" name="FileUpload1" wizardTheme="Inline" wizardThemeType="File" fieldSource="icono" caption="icono" disallowedFileMasks="*.htm;*.html;*.php" processedFileFolder="images" PathID="menuFileUpload1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</FileUpload>
				<TextBox id="17" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="accion" fieldSource="accion" required="False" caption="Accion" wizardCaption="Accion" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False" visible="Yes" PathID="menuaccion">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="18" fieldSourceType="DBColumn" sourceType="Table" dataType="Integer" editable="True" hasErrorCollection="True" returnValueType="Number" name="niver_minimo_id" fieldSource="niver_minimo_id" required="False" caption="Niver Minimo Id" wizardCaption="Niver Minimo Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardEmptyCaption="Seleccionar Valor" connection="Datos" dataSource="niveles_acceso" activeCollection="TableParameters" activeTableType="dataSource" orderBy="nom_nivel_acceso" boundColumn="usuario_id" textColumn="nom_usuario" visible="Yes" PathID="menuniver_minimo_id">
					<Components/>
					<Events/>
					<TableParameters>
						<TableParameter id="25" conditionType="Parameter" useIsNull="False" field="nivel_acceso_id" dataType="Integer" searchConditionType="LessThanOrEqual" parameterType="Expression" logicOperator="And" defaultValue="0" parameterSource="CCGetGroupID()" orderNumber="1"/>
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
				<CheckBox id="19" fieldSourceType="CodeExpression" dataType="Boolean" editable="True" name="CheckBox_Delete" checkedValue="true" uncheckedValue="false" wizardCaption="Borrar" wizardTheme="Inline" wizardThemeType="File" wizardUseTemplateBlock="True" visible="Yes" PathID="menuCheckBox_Delete" defaultValue="Unchecked">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</CheckBox>
				<Navigator id="20" type="Centered" name="Navigator" size="10" wizardPagingType="Centered" wizardFirst="True" wizardFirstText="Inicio" wizardPrev="True" wizardPrevText="Anterior" wizardNext="True" wizardNextText="Siguiente" wizardLast="True" wizardLastText="Final" wizardImages="False" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="False" wizardTheme="Inline" wizardThemeType="File" wizardImagesScheme="Inline" pageSizes="1;5;10;25;50" PathID="menuNavigator">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Button id="21" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Submit" operation="Submit" wizardCaption="Grabar" wizardTheme="Inline" wizardThemeType="File" PathID="menuButton_Submit">
					<Components/>
					<Events>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Confirmation Message" actionCategory="General" id="22" message="Enviar registro?"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="23" urlType="Relative" enableValidation="False" isDefault="False" name="Cancel" operation="Cancel" wizardCaption="Cancelar" wizardTheme="Inline" wizardThemeType="File" PathID="menuCancel">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="9" conditionType="Parameter" useIsNull="False" field="caption" parameterSource="s_caption" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="1"/>
				<TableParameter id="10" conditionType="Parameter" useIsNull="False" field="niver_minimo_id" parameterSource="s_niver_minimo_id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="2"/>
				<TableParameter id="26" conditionType="Parameter" useIsNull="False" field="niver_minimo_id" dataType="Integer" searchConditionType="LessThanOrEqual" parameterType="Expression" logicOperator="And" defaultValue="0" parameterSource="CCGetGroupID()" orderNumber="3"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<PKFields>
				<PKField id="8" tableName="menu" fieldName="menu_id" dataType="Integer"/>
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
		<CodeFile id="Code" language="PHPTemplates" name="cfg_menus.php" comment="//" codePage="utf-8" forShow="True" url="cfg_menus.php"/>
		<CodeFile id="Events" language="PHPTemplates" name="cfg_menus_events.php" forShow="False" comment="//" codePage="utf-8"/>
	</CodeFiles>
	<SecurityGroups/>
	<Events>
		<Event name="BeforeOutput" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="27"/>
			</Actions>
		</Event>
	</Events>
	<CachingParameters/>
	<Attributes/>
	<Features/>
</Page>

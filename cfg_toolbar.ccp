<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" wizardTheme="InLine" wizardThemeType="File" needGeneration="0" accessDeniedPage="error_nivel.ccp" cachingEnabled="False" cachingDuration="1 minutes" isService="False">
	<Components>
		<Record id="20" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" debugMode="False" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="tool_barSearch" wizardCaption="Buscar Tool Bar " wizardTheme="Inline" wizardThemeType="File" wizardOrientation="Vertical" wizardFormMethod="post" returnPage="cfg_toolbar.ccp" PathID="tool_barSearch">
			<Components>
				<ListBox id="22" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="s_usuario_id" wizardCaption="Usuario Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" sourceType="Table" connection="Datos" dataSource="usuarios" boundColumn="usuario_id" textColumn="nom_usuario" activeCollection="TableParameters" activeTableType="dataSource" orderBy="nom_usuario" visible="Yes" PathID="tool_barSearchs_usuario_id">
					<Components/>
					<Events/>
					<TableParameters>
						<TableParameter id="56" conditionType="Parameter" useIsNull="False" field="usuario_id" dataType="Integer" searchConditionType="Equal" parameterType="Expression" logicOperator="Or" parameterSource="CCGetUserID()" orderNumber="1"/>
						<TableParameter id="57" conditionType="Expression" useIsNull="False" searchConditionType="Equal" parameterType="URL" logicOperator="And" expression="&quot; . CCGetGroupID() . &quot; &gt; 16" orderNumber="2"/>
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
				<TextBox id="23" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="s_contenido" wizardCaption="Caption" wizardTheme="Inline" wizardThemeType="File" wizardSize="15" wizardMaxLength="15" wizardIsPassword="False" visible="Yes" PathID="tool_barSearchs_contenido">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Button id="21" urlType="Relative" enableValidation="True" isDefault="True" name="Button_DoSearch" operation="Search" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Buscar" PathID="tool_barSearchButton_DoSearch">
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
		<EditableGrid id="19" urlType="Relative" secured="False" emptyRows="1" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" sourceType="Table" defaultPageSize="10" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="tool_bar" connection="Datos" dataSource="tool_bar" pageSizeLimit="100" wizardCaption="Lista de Tool Bar " wizardTheme="Inline" wizardThemeType="File" wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAltRecord="False" wizardRecordSeparator="False" deleteControl="CheckBox_Delete" activeCollection="TableParameters" activeTableType="dataSource" orderBy="usuario_id, caption" PathID="tool_bar">
			<Components>
				<Label id="26" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="tool_bar_TotalRecords" wizardTheme="Inline" wizardThemeType="File" wizardUseTemplateBlock="False">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Retrieve number of records" actionCategory="Database" id="27"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Sorter id="31" visible="True" name="Sorter_caption" column="caption" wizardCaption="Caption" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="caption" PathID="tool_barSorter_caption">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="32" visible="True" name="Sorter_tooltip" column="tooltip" wizardCaption="Tooltip" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="tooltip" PathID="tool_barSorter_tooltip">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="35" visible="True" name="Sorter_accion" column="accion" wizardCaption="Accion" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="accion" PathID="tool_barSorter_accion">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="36" visible="True" name="Sorter_usuario_id" column="usuario_id" wizardCaption="Usuario Id" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="usuario_id" PathID="tool_barSorter_usuario_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="37" visible="True" name="Sorter_actulizar" column="actulizar" wizardCaption="Actulizar" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="actulizar" PathID="tool_barSorter_actulizar">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="38" visible="True" name="Sorter_usar_en" column="usar_en" wizardCaption="Usar En" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="usar_en" PathID="tool_barSorter_usar_en">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<TextBox id="39" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="caption" fieldSource="caption" caption="Caption" wizardCaption="Caption" wizardTheme="Inline" wizardThemeType="File" wizardSize="15" wizardMaxLength="15" wizardIsPassword="False" wizardUseTemplateBlock="False" required="True" visible="Yes" PathID="tool_barcaption">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="40" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="tooltip" fieldSource="tooltip" caption="Tooltip" wizardCaption="Tooltip" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" required="True" visible="Yes" PathID="tool_bartooltip">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="43" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="accion" fieldSource="accion" caption="Accion" wizardCaption="Accion" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False" required="True" visible="Yes" PathID="tool_baraccion">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="44" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="usuario_id" fieldSource="usuario_id" caption="Usuario Id" wizardCaption="Usuario Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" sourceType="Table" connection="Datos" dataSource="usuarios" boundColumn="usuario_id" textColumn="nom_usuario" activeCollection="TableParameters" activeTableType="dataSource" required="True" visible="Yes" PathID="tool_barusuario_id">
					<Components/>
					<Events/>
					<TableParameters>
						<TableParameter id="52" conditionType="Parameter" useIsNull="False" field="usuario_id" dataType="Integer" searchConditionType="Equal" parameterType="Expression" logicOperator="Or" parameterSource="CCGetUserID()" orderNumber="1"/>
						<TableParameter id="53" conditionType="Expression" useIsNull="False" searchConditionType="Equal" parameterType="URL" logicOperator="And" expression="&quot; . CCGetGroupID() . &quot; &gt; 16" orderNumber="2"/>
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
				<CheckBox id="45" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="actulizar" fieldSource="actulizar" required="False" caption="Actulizar" wizardCaption="Actulizar" wizardTheme="Inline" wizardThemeType="File" wizardSize="1" wizardMaxLength="1" wizardIsPassword="False" wizardUseTemplateBlock="False" checkedValue="'V'" uncheckedValue="'F'" visible="Yes" PathID="tool_baractulizar" defaultValue="Unchecked">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</CheckBox>
				<ListBox id="46" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="usar_en" fieldSource="usar_en" caption="Usar En" wizardCaption="Usar En" wizardTheme="Inline" wizardThemeType="File" wizardSize="3" wizardMaxLength="3" wizardIsPassword="False" wizardUseTemplateBlock="False" sourceType="ListOfValues" _valueOfList="DOS" _nameOfList="Ambos" dataSource="WIN;Windows;WEB;Web;DOS;Ambos" required="True" visible="Yes" PathID="tool_barusar_en">
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
				<CheckBox id="47" fieldSourceType="CodeExpression" dataType="Boolean" editable="True" name="CheckBox_Delete" checkedValue="true" uncheckedValue="false" wizardCaption="Borrar" wizardTheme="Inline" wizardThemeType="File" wizardUseTemplateBlock="True" visible="Yes" PathID="tool_barCheckBox_Delete" defaultValue="Unchecked">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</CheckBox>
				<Navigator id="48" type="Simple" name="Navigator" wizardPagingType="Custom" wizardFirst="True" wizardFirstText="Inicio" wizardPrev="True" wizardPrevText="Anterior" wizardNext="True" wizardNextText="Siguiente" wizardLast="True" wizardLastText="Final" wizardImages="True" wizardPageNumbers="Simple" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="True" wizardTheme="Inline" wizardThemeType="File" wizardImagesScheme="Inline" size="10" pageSizes="1;5;10;25;50" PathID="tool_barNavigator">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Button id="49" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Submit" operation="Submit" wizardCaption="Grabar" wizardTheme="Inline" wizardThemeType="File" PathID="tool_barButton_Submit">
					<Components/>
					<Events>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Confirmation Message" actionCategory="General" id="50" message="Enviar registro?"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="51" urlType="Relative" enableValidation="False" isDefault="False" name="Cancel" operation="Cancel" wizardCaption="Cancelar" wizardTheme="Inline" wizardThemeType="File" PathID="tool_barCancel">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="28" conditionType="Parameter" useIsNull="False" field="usuario_id" parameterSource="s_usuario_id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1"/>
				<TableParameter id="29" conditionType="Parameter" useIsNull="False" field="caption" parameterSource="s_caption" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="2"/>
				<TableParameter id="30" conditionType="Parameter" useIsNull="False" field="accion" parameterSource="s_accion" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="3"/>
				<TableParameter id="54" conditionType="Parameter" useIsNull="False" field="usuario_id" dataType="Integer" searchConditionType="Equal" parameterType="Expression" logicOperator="Or" parameterSource="CCGetUserID()" orderNumber="4" leftBrackets="1"/>
				<TableParameter id="55" conditionType="Expression" useIsNull="False" searchConditionType="Equal" parameterType="URL" logicOperator="And" expression="&quot; .  CCGetGroupID() . &quot; &gt; 16" orderNumber="5" rightBrackets="1"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<PKFields>
				<PKField id="25" tableName="tool_bar" fieldName="tool_bar_id" dataType="Integer"/>
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
		<CodeFile id="Code" language="PHPTemplates" name="cfg_toolbar.php" comment="//" codePage="utf-8" forShow="True" url="cfg_toolbar.php"/>
		<CodeFile id="Events" language="PHPTemplates" forShow="False" name="cfg_toolbar_events.php" codePage="utf-8" comment="//"/>
	</CodeFiles>
	<SecurityGroups>
		<Group id="2" groupID="4"/>
		<Group id="3" groupID="5"/>
		<Group id="4" groupID="6"/>
		<Group id="5" groupID="7"/>
		<Group id="6" groupID="8"/>
		<Group id="7" groupID="9"/>
		<Group id="8" groupID="10"/>
		<Group id="9" groupID="11"/>
		<Group id="10" groupID="12"/>
		<Group id="11" groupID="13"/>
		<Group id="12" groupID="14"/>
		<Group id="13" groupID="15"/>
		<Group id="14" groupID="16"/>
		<Group id="15" groupID="17"/>
		<Group id="16" groupID="18"/>
		<Group id="17" groupID="19"/>
		<Group id="18" groupID="20"/>
	</SecurityGroups>
	<Events>
		<Event name="BeforeOutput" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="58"/>
			</Actions>
		</Event>
	</Events>
	<CachingParameters/>
	<Attributes/>
	<Features/>
</Page>

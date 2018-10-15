<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" wizardTheme="InLine" wizardThemeType="File" needGeneration="0" accessDeniedPage="error_nivel.ccp" cachingEnabled="False" cachingDuration="1 minutes" isService="False">
	<Components>
		<Record id="17" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" debugMode="False" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="estadosSearch" wizardCaption="Buscar  " wizardTheme="Inline" wizardThemeType="File" wizardOrientation="Vertical" wizardFormMethod="post" returnPage="add_estados.ccp" PathID="estadosSearch">
			<Components>
				<ListBox id="20" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" editable="True" hasErrorCollection="True" returnValueType="Number" name="s_usar_en" wizardCaption="Usar En" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardEmptyCaption="Seleccionar Valor" connection="Datos" dataSource="estados_uso" boundColumn="nom_estado" textColumn="nom_estado_uso" visible="Yes" PathID="estadosSearchs_usar_en">
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
				<Button id="18" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Buscar" PathID="estadosSearchButton_DoSearch">
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
		<EditableGrid id="2" urlType="Relative" secured="False" emptyRows="1" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" sourceType="Table" defaultPageSize="10" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="estados" connection="Datos" dataSource="estados" pageSizeLimit="100" wizardCaption="Lista de Estados " wizardTheme="Inline" wizardThemeType="File" wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAltRecord="False" wizardRecordSeparator="False" deleteControl="CheckBox_Delete" activeCollection="TableParameters" activeTableType="dataSource" wizardAllowSorting="True" wizardUsePageScroller="True" PathID="estados">
			<Components>
				<Label id="4" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="estados_TotalRecords" wizardTheme="Inline" wizardThemeType="File" wizardUseTemplateBlock="False">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Retrieve number of records" actionCategory="Database" id="5"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Sorter id="23" visible="True" name="ID" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="Simple" connection="Datos" column="estado_id" PathID="estadosID">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="6" visible="True" name="Sorter_nom_estado" column="nom_estado" wizardCaption="Nom Estado" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="nom_estado" PathID="estadosSorter_nom_estado">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="7" visible="True" name="Sorter_usar_en" column="usar_en" wizardCaption="Usar En" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="usar_en" PathID="estadosSorter_usar_en">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<TextBox id="22" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="estado_id" wizardTheme="Inline" wizardThemeType="File" fieldSource="estado_id" required="True" unique="True" visible="Yes" PathID="estadosestado_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="8" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="nom_estado" fieldSource="nom_estado" required="True" caption="Nombre de estado" wizardCaption="Nom Estado" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" visible="Yes" PathID="estadosnom_estado">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="9" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="usar_en" fieldSource="usar_en" required="True" caption="usar en" wizardCaption="Usar En" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" sourceType="Table" _valueOfList="resultados" _nameOfList="Estado para los Resultados" connection="Datos" dataSource="estados_uso" boundColumn="nom_estado" textColumn="nom_estado_uso" visible="Yes" PathID="estadosusar_en">
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
				<CheckBox id="16" fieldSourceType="DBColumn" dataType="Boolean" editable="True" name="predeterminado" wizardTheme="Inline" wizardThemeType="File" fieldSource="predeterminado" checkedValue="V" uncheckedValue="F" visible="Yes" PathID="estadospredeterminado" defaultValue="Unchecked">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</CheckBox>
				<CheckBox id="15" fieldSourceType="DBColumn" dataType="Boolean" editable="True" name="activo" wizardTheme="Inline" wizardThemeType="File" fieldSource="activo" checkedValue="'V'" uncheckedValue="'F'" visible="Yes" PathID="estadosactivo" defaultValue="Unchecked">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</CheckBox>
				<CheckBox id="21" fieldSourceType="DBColumn" dataType="Boolean" editable="True" name="visible_validacion" wizardTheme="Inline" wizardThemeType="File" fieldSource="visible_validacion" checkedValue="'V'" uncheckedValue="'F'" defaultValue="Unchecked" visible="Yes" PathID="estadosvisible_validacion">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</CheckBox>
				<CheckBox id="10" fieldSourceType="CodeExpression" dataType="Boolean" editable="True" name="CheckBox_Delete" checkedValue="true" uncheckedValue="false" wizardCaption="Borrar" wizardTheme="Inline" wizardThemeType="File" wizardUseTemplateBlock="True" visible="Yes" PathID="estadosCheckBox_Delete" defaultValue="Unchecked">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</CheckBox>
				<Navigator id="24" type="Simple" name="Navigator1" wizardPagingType="Custom" wizardPageNumbers="Simple" wizardTotalPages="True" wizardImages="True" wizardHideDisabled="True" wizardFirst="True" wizardPrev="True" wizardNext="True" wizardLast="True" wizardFirstText="Inicio" wizardPrevText="Anterior" wizardNextText="Siguiente" wizardLastText="Final" wizardOfText="de" wizardTheme="InLine" wizardThemeType="File" wizardImagesScheme="Square" size="10" pageSizes="1;5;10;25;50" PathID="estadosNavigator1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Button id="12" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Submit" operation="Submit" wizardCaption="Enviar" wizardTheme="Inline" wizardThemeType="File" PathID="estadosButton_Submit">
					<Components/>
					<Events>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Confirmation Message" actionCategory="General" id="13" message="Enviar registro?"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="14" urlType="Relative" enableValidation="False" isDefault="False" name="Cancel" operation="Cancel" wizardCaption="Cancelar" wizardTheme="Inline" wizardThemeType="File" returnPage="menu_principal.ccp" PathID="estadosCancel">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="19" conditionType="Parameter" useIsNull="False" field="usar_en" parameterSource="s_usar_en" dataType="Text" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<PKFields>
				<PKField id="3" tableName="estados" fieldName="estado_id" dataType="Integer"/>
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
		<CodeFile id="Events" language="PHPTemplates" name="add_estados_events.php" comment="//" codePage="utf-8" forShow="False"/>
		<CodeFile id="Code" language="PHPTemplates" name="add_estados.php" comment="//" codePage="utf-8" forShow="True" url="add_estados.php"/>
	</CodeFiles>
	<SecurityGroups>
		<Group id="25" groupID="20"/>
	</SecurityGroups>
	<Events>
		<Event name="BeforeOutput" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="26"/>
			</Actions>
		</Event>
	</Events>
	<CachingParameters/>
	<Attributes/>
	<Features/>
</Page>

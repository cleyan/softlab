<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" wizardTheme="InLine" wizardThemeType="File" needGeneration="0" accessDeniedPage="error_nivel.ccp" cachingEnabled="False" cachingDuration="1 minutes" isService="False">
	<Components>
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" debugMode="False" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="indicaciones_muestraSearch" wizardCaption="Buscar Indicaciones Muestra " wizardTheme="Inline" wizardThemeType="File" wizardOrientation="Vertical" wizardFormMethod="post" returnPage="add_indicaciones_muestra.ccp" PathID="indicaciones_muestraSearch">
			<Components>
				<TextBox id="5" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="s_nom_indicacion" wizardCaption="Nom Indicacion" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" visible="Yes" PathID="indicaciones_muestraSearchs_nom_indicacion">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="6" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="s_activo" wizardCaption="Activo" wizardTheme="Inline" wizardThemeType="File" wizardSize="1" wizardMaxLength="1" wizardIsPassword="False" sourceType="ListOfValues" _valueOfList="F" _nameOfList="No activo" dataSource="V;Activo;F;No activo" visible="Yes" PathID="indicaciones_muestraSearchs_activo">
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
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="True" name="Button_DoSearch" operation="Search" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Buscar" PathID="indicaciones_muestraSearchButton_DoSearch">
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
		<EditableGrid id="2" urlType="Relative" secured="False" emptyRows="2" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" sourceType="Table" defaultPageSize="10" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="indicaciones_muestra" connection="Datos" dataSource="indicaciones_muestra" pageSizeLimit="100" wizardCaption="Lista de Indicaciones Muestra " wizardTheme="Inline" wizardThemeType="File" wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAltRecord="False" wizardRecordSeparator="False" deleteControl="CheckBox_Delete" activeCollection="TableParameters" activeTableType="dataSource" orderBy="nom_indicacion, activo" PathID="indicaciones_muestra">
			<Components>
				<Label id="8" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="indicaciones_muestra_TotalRecords" wizardTheme="Inline" wizardThemeType="File" wizardUseTemplateBlock="False">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Retrieve number of records" actionCategory="Database" id="9"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Sorter id="12" visible="True" name="Sorter_nom_indicacion" column="nom_indicacion" wizardCaption="Nom Indicacion" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="nom_indicacion" PathID="indicaciones_muestraSorter_nom_indicacion">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<TextBox id="14" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="nom_indicacion" fieldSource="nom_indicacion" required="False" caption="Nom Indicacion" wizardCaption="Nom Indicacion" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" visible="Yes" PathID="indicaciones_muestranom_indicacion">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextArea id="15" fieldSourceType="DBColumn" dataType="Memo" html="False" editable="True" hasErrorCollection="True" name="cuerpo_indicacion" fieldSource="cuerpo_indicacion" required="False" caption="Cuerpo Indicacion" wizardCaption="Cuerpo Indicacion" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardRows="3" visible="Yes" PathID="indicaciones_muestracuerpo_indicacion">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextArea>
				<CheckBox id="16" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="activo" fieldSource="activo" required="False" caption="Activo" wizardCaption="Activo" wizardTheme="Inline" wizardThemeType="File" wizardSize="1" wizardMaxLength="1" wizardIsPassword="False" wizardUseTemplateBlock="False" checkedValue="'V'" uncheckedValue="'F'" visible="Yes" PathID="indicaciones_muestraactivo" defaultValue="Unchecked">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</CheckBox>
				<CheckBox id="17" fieldSourceType="CodeExpression" dataType="Boolean" editable="True" name="CheckBox_Delete" checkedValue="true" uncheckedValue="false" wizardCaption="Borrar" wizardTheme="Inline" wizardThemeType="File" wizardUseTemplateBlock="True" visible="Yes" PathID="indicaciones_muestraCheckBox_Delete" defaultValue="Unchecked">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</CheckBox>
				<Navigator id="18" type="Centered" name="Navigator" size="10" wizardPagingType="Centered" wizardFirst="True" wizardFirstText="Inicio" wizardPrev="True" wizardPrevText="Anterior" wizardNext="True" wizardNextText="Siguiente" wizardLast="True" wizardLastText="Final" wizardImages="False" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="False" wizardTheme="Inline" wizardThemeType="File" wizardImagesScheme="Inline" pageSizes="1;5;10;25;50" PathID="indicaciones_muestraNavigator">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Button id="19" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Submit" operation="Submit" wizardCaption="Grabar" wizardTheme="Inline" wizardThemeType="File" PathID="indicaciones_muestraButton_Submit">
					<Components/>
					<Events>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Confirmation Message" actionCategory="General" id="20" message="Enviar registro?"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="21" urlType="Relative" enableValidation="False" isDefault="False" name="Cancel" operation="Cancel" wizardCaption="Cancelar" wizardTheme="Inline" wizardThemeType="File" PathID="indicaciones_muestraCancel">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="10" conditionType="Parameter" useIsNull="False" field="nom_indicacion" parameterSource="s_nom_indicacion" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="1"/>
				<TableParameter id="11" conditionType="Parameter" useIsNull="False" field="activo" parameterSource="s_activo" dataType="Text" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="2"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<PKFields>
				<PKField id="7" tableName="indicaciones_muestra" fieldName="indicacion_muestra_id" dataType="Integer"/>
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
		<CodeFile id="Events" language="PHPTemplates" name="add_indicaciones_muestra_events.php" comment="//" codePage="utf-8" forShow="False"/>
		<CodeFile id="Code" language="PHPTemplates" name="add_indicaciones_muestra.php" comment="//" codePage="utf-8" forShow="True" url="add_indicaciones_muestra.php"/>
	</CodeFiles>
	<SecurityGroups>
		<Group id="22" groupID="12"/>
		<Group id="23" groupID="13"/>
		<Group id="24" groupID="14"/>
		<Group id="25" groupID="15"/>
		<Group id="26" groupID="16"/>
		<Group id="27" groupID="17"/>
		<Group id="28" groupID="18"/>
		<Group id="29" groupID="19"/>
		<Group id="30" groupID="20"/>
	</SecurityGroups>
	<Events>
		<Event name="BeforeOutput" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="31"/>
			</Actions>
		</Event>
	</Events>
	<CachingParameters/>
	<Attributes/>
	<Features/>
</Page>

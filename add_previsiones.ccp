<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" wizardTheme="InLine" wizardThemeType="File" needGeneration="0" accessDeniedPage="error_nivel.ccp" cachingEnabled="False" cachingDuration="1 minutes" isService="False">
	<Components>
		<Record id="16" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" debugMode="False" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="previsionesSearch" wizardCaption="Buscar Previsiones " wizardTheme="Inline" wizardThemeType="File" wizardOrientation="Vertical" wizardFormMethod="post" returnPage="add_previsiones.ccp" PathID="previsionesSearch">
			<Components>
				<TextBox id="18" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="s_nom_prevision" wizardCaption="Nom Prevision" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" visible="Yes" PathID="previsionesSearchs_nom_prevision">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Button id="17" urlType="Relative" enableValidation="True" isDefault="True" name="Button_DoSearch" operation="Search" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Buscar" PathID="previsionesSearchButton_DoSearch">
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
		<EditableGrid id="15" urlType="Relative" secured="False" emptyRows="1" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" sourceType="Table" defaultPageSize="10" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="previsiones1" connection="Datos" dataSource="previsiones" orderBy="nom_prevision" pageSizeLimit="100" wizardCaption="Lista de Previsiones " wizardTheme="Inline" wizardThemeType="File" wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAltRecord="False" wizardRecordSeparator="False" deleteControl="CheckBox_Delete" PathID="previsiones1">
			<Components>
				<Label id="20" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="previsiones1_TotalRecords" wizardTheme="Inline" wizardThemeType="File" wizardUseTemplateBlock="False">
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
				<Sorter id="23" visible="True" name="Sorter_nom_prevision" column="nom_prevision" wizardCaption="Nom Prevision" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="nom_prevision" PathID="previsiones1Sorter_nom_prevision">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="24" visible="True" name="Sorter_activo" column="activo" wizardCaption="Activo" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="activo" PathID="previsiones1Sorter_activo">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<TextBox id="25" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="nom_prevision" fieldSource="nom_prevision" caption="Nom Prevision" wizardCaption="Nom Prevision" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False" required="True" unique="True" visible="Yes" PathID="previsiones1nom_prevision">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<RadioButton id="26" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="activo" fieldSource="activo" caption="Activo" wizardCaption="Activo" wizardTheme="Inline" wizardThemeType="File" wizardSize="1" wizardMaxLength="1" wizardIsPassword="False" wizardUseTemplateBlock="False" sourceType="ListOfValues" _valueOfList="F" _nameOfList="No Activo" dataSource="V;Activo;F;No Activo" required="True" visible="Yes" PathID="previsiones1activo">
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
				</RadioButton>
				<CheckBox id="27" fieldSourceType="CodeExpression" dataType="Boolean" editable="True" name="CheckBox_Delete" checkedValue="true" uncheckedValue="false" wizardCaption="Borrar" wizardTheme="Inline" wizardThemeType="File" wizardUseTemplateBlock="True" visible="Yes" PathID="previsiones1CheckBox_Delete" defaultValue="Unchecked">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</CheckBox>
				<Navigator id="28" type="Simple" name="Navigator" wizardPagingType="Custom" wizardFirst="True" wizardFirstText="Inicio" wizardPrev="True" wizardPrevText="Anterior" wizardNext="True" wizardNextText="Siguiente" wizardLast="True" wizardLastText="Final" wizardImages="True" wizardPageNumbers="Simple" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="True" wizardTheme="Inline" wizardThemeType="File" wizardImagesScheme="Inline" size="10" pageSizes="1;5;10;25;50" PathID="previsiones1Navigator">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Button id="29" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Submit" operation="Submit" wizardCaption="Grabar" wizardTheme="Inline" wizardThemeType="File" PathID="previsiones1Button_Submit">
					<Components/>
					<Events>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Confirmation Message" actionCategory="General" id="30" message="Enviar registro?"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="31" urlType="Relative" enableValidation="False" isDefault="False" name="Cancel" operation="Cancel" wizardCaption="Cancelar" wizardTheme="Inline" wizardThemeType="File" returnPage="menu_principal.ccp" PathID="previsiones1Cancel">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="22" conditionType="Parameter" useIsNull="False" field="nom_prevision" parameterSource="s_nom_prevision" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="1"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<PKFields>
				<PKField id="19" tableName="previsiones" fieldName="prevision_id" dataType="Integer"/>
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
		<CodeFile id="Events" language="PHPTemplates" name="add_previsiones_events.php" comment="//" codePage="utf-8" forShow="False"/>
		<CodeFile id="Code" language="PHPTemplates" name="add_previsiones.php" comment="//" codePage="utf-8" forShow="True" url="add_previsiones.php"/>
	</CodeFiles>
	<SecurityGroups>
		<Group id="32" groupID="17"/>
		<Group id="33" groupID="18"/>
		<Group id="34" groupID="19"/>
		<Group id="35" groupID="20"/>
	</SecurityGroups>
	<Events>
		<Event name="BeforeOutput" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="36"/>
			</Actions>
		</Event>
	</Events>
	<CachingParameters/>
	<Attributes/>
	<Features/>
</Page>

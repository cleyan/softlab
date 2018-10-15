<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" wizardTheme="InLine" wizardThemeType="File" needGeneration="0" accessDeniedPage="error_nivel.ccp" cachingEnabled="False" cachingDuration="1 minutes" isService="False">
	<Components>
		<EditableGrid id="7" urlType="Relative" secured="False" emptyRows="1" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" sourceType="Table" defaultPageSize="10" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="formatos" connection="Datos" dataSource="formatos" pageSizeLimit="100" wizardCaption="Lista de Formatos " wizardTheme="Inline" wizardThemeType="File" wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAltRecord="False" wizardRecordSeparator="False" deleteControl="CheckBox_Delete" PathID="formatos">
			<Components>
				<Label id="9" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="formatos_TotalRecords" wizardTheme="Inline" wizardThemeType="File" wizardUseTemplateBlock="False">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Retrieve number of records" actionCategory="Database" id="10"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Sorter id="11" visible="True" name="Sorter_nom_formato" column="nom_formato" wizardCaption="Nom Formato" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="nom_formato" PathID="formatosSorter_nom_formato">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="12" visible="True" name="Sorter_formato" column="formato" wizardCaption="Formato" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="formato" PathID="formatosSorter_formato">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<TextBox id="14" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="nom_formato" fieldSource="nom_formato" required="False" caption="Nom Formato" wizardCaption="Nom Formato" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" visible="Yes" PathID="formatosnom_formato">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="15" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="formato" fieldSource="formato" required="False" caption="Formato" wizardCaption="Formato" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" visible="Yes" PathID="formatosformato">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<CheckBox id="16" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="activo" fieldSource="activo" required="False" caption="Activo" wizardCaption="Activo" wizardTheme="Inline" wizardThemeType="File" wizardSize="1" wizardMaxLength="1" wizardIsPassword="False" wizardUseTemplateBlock="False" checkedValue="'V'" uncheckedValue="'F'" visible="Yes" PathID="formatosactivo" defaultValue="Unchecked">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</CheckBox>
				<CheckBox id="17" fieldSourceType="CodeExpression" dataType="Boolean" editable="True" name="CheckBox_Delete" checkedValue="true" uncheckedValue="false" wizardCaption="Borrar" wizardTheme="Inline" wizardThemeType="File" wizardUseTemplateBlock="True" visible="Yes" PathID="formatosCheckBox_Delete" defaultValue="Unchecked">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</CheckBox>
				<Navigator id="18" type="Centered" name="Navigator" size="10" wizardPagingType="Centered" wizardFirst="True" wizardFirstText="Inicio" wizardPrev="True" wizardPrevText="Anterior" wizardNext="True" wizardNextText="Siguiente" wizardLast="True" wizardLastText="Final" wizardImages="False" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="False" wizardTheme="Inline" wizardThemeType="File" wizardImagesScheme="Inline" pageSizes="1;5;10;25;50" PathID="formatosNavigator">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Button id="19" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Submit" operation="Submit" wizardCaption="Grabar" wizardTheme="Inline" wizardThemeType="File" PathID="formatosButton_Submit">
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
				<Button id="21" urlType="Relative" enableValidation="False" isDefault="False" name="Cancel" operation="Cancel" wizardCaption="Cancelar" wizardTheme="Inline" wizardThemeType="File" PathID="formatosCancel">
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
			<PKFields>
				<PKField id="8" tableName="formatos" fieldName="formato_id" dataType="Integer"/>
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
		<CodeFile id="Events" language="PHPTemplates" name="add_formatos_events.php" comment="//" codePage="utf-8" forShow="False"/>
		<CodeFile id="Code" language="PHPTemplates" name="add_formatos.php" comment="//" codePage="utf-8" forShow="True" url="add_formatos.php"/>
	</CodeFiles>
	<SecurityGroups>
		<Group id="22" groupID="20"/>
	</SecurityGroups>
	<Events>
		<Event name="BeforeOutput" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="23"/>
			</Actions>
		</Event>
	</Events>
	<CachingParameters/>
	<Attributes/>
	<Features/>
</Page>

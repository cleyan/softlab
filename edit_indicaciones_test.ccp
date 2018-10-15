<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" wizardTheme="InLine" wizardThemeType="File" cachingEnabled="False" cachingDuration="1 minutes" needGeneration="0" isService="False">
	<Components>
		<Record id="2" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" debugMode="False" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="Datos" name="indicaciones_test" dataSource="indicaciones_test" errorSummator="Error" wizardCaption="Agregar/Editar Indicaciones Test " wizardTheme="Inline" wizardThemeType="File" wizardFormMethod="post" returnPage="add_indicaciones_test.ccp" PathID="indicaciones_test">
			<Components>
				<TextBox id="9" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="nom_indicacion" fieldSource="nom_indicacion" caption="Nom Indicacion" wizardCaption="Nom Indicacion" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" required="True" visible="Yes" PathID="indicaciones_testnom_indicacion">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<RadioButton id="11" fieldSourceType="DBColumn" dataType="Text" editable="True" name="activo" fieldSource="activo" caption="Activo" wizardCaption="Activo" wizardTheme="Inline" wizardThemeType="File" wizardSize="1" wizardMaxLength="1" wizardIsPassword="False" wizardUseTemplateBlock="False" checkedValue="'V'" uncheckedValue="'F'" sourceType="ListOfValues" html="True" _valueOfList="F" _nameOfList="Inactivo" dataSource="V;Activo;F;Inactivo" required="True" visible="Yes" PathID="indicaciones_testactivo">
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
				<TextArea id="10" fieldSourceType="DBColumn" dataType="Memo" html="False" editable="True" hasErrorCollection="True" name="cuerpo_indicacion" fieldSource="cuerpo_indicacion" caption="Cuerpo Indicacion" wizardCaption="Cuerpo Indicacion" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardRows="3" required="True" visible="Yes" PathID="indicaciones_testcuerpo_indicacion">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextArea>
				<Button id="3" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Agregar" PathID="indicaciones_testButton_Insert">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Grabar" PathID="indicaciones_testButton_Update">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="5" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Borrar" PathID="indicaciones_testButton_Delete">
					<Components/>
					<Events>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Confirmation Message" actionCategory="General" id="6" message="Borrar registro?"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="7" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Cancelar" PathID="indicaciones_testButton_Cancel">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="8" conditionType="Parameter" useIsNull="False" field="indicacion_test_id" parameterSource="indicacion_test_id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1"/>
			</TableParameters>
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
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="edit_indicaciones_test.php" comment="//" codePage="utf-8" forShow="True" url="edit_indicaciones_test.php"/>
		<CodeFile id="Events" language="PHPTemplates" name="edit_indicaciones_test_events.php" forShow="False" comment="//" codePage="utf-8"/>
	</CodeFiles>
	<SecurityGroups/>
	<Events>
		<Event name="BeforeOutput" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="12"/>
			</Actions>
		</Event>
	</Events>
	<CachingParameters/>
	<Attributes/>
	<Features/>
</Page>

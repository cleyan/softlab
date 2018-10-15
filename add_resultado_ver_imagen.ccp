<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" wizardTheme="InLine" wizardThemeType="File" needGeneration="0" accessDeniedPage="error_nivel.ccp" cachingEnabled="False" cachingDuration="1 minutes" isService="False">
	<Components>
		<Record id="39" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" debugMode="False" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="Datos" name="resultados" dataSource="resultados" errorSummator="Error" wizardCaption="Agregar/Editar Resultados " wizardTheme="Inline" wizardThemeType="File" wizardFormMethod="post" returnPage="add_resultado_ver_imagen.ccp" PathID="resultados">
			<Components>
				<TextBox id="50" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="valor" wizardTheme="Inline" wizardThemeType="File" fieldSource="valor" visible="Yes" PathID="resultadosvalor">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<FileUpload id="47" fieldSourceType="DBColumn" allowedFileMasks="*.bmp" fileSizeLimit="300000" dataType="Text" tempFileFolder="TEMP" name="archivo" wizardTheme="Inline" wizardThemeType="File" fieldSource="archivo" processedFileFolder="resultado" PathID="resultadosarchivo">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</FileUpload>
				<Label id="48" fieldSourceType="DBColumn" dataType="Text" html="True" editable="False" name="img_archivo" wizardTheme="Inline" wizardThemeType="File">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="49"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Button id="40" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Agregar" PathID="resultadosButton_Insert">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="41" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Grabar" PathID="resultadosButton_Update">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="42" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Borrar" returnPage="closeandrefresh.ccp" PathID="resultadosButton_Delete">
					<Components/>
					<Events>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Confirmation Message" actionCategory="General" id="43" message="Borrar registro?"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="44" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Cancelar" returnPage="closeandrefresh.ccp" PathID="resultadosButton_Cancel">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="45" conditionType="Parameter" useIsNull="False" field="resultado_id" parameterSource="resultado_id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1"/>
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
		<CodeFile id="Code" language="PHPTemplates" name="add_resultado_ver_imagen.php" comment="//" codePage="utf-8" forShow="True" url="add_resultado_ver_imagen.php"/>
		<CodeFile id="Events" language="PHPTemplates" forShow="False" name="add_resultado_ver_imagen_events.php" codePage="utf-8" comment="//"/>
	</CodeFiles>
	<SecurityGroups>
		<Group id="28" groupID="5"/>
		<Group id="29" groupID="11"/>
		<Group id="30" groupID="12"/>
		<Group id="31" groupID="13"/>
		<Group id="32" groupID="14"/>
		<Group id="33" groupID="15"/>
		<Group id="34" groupID="16"/>
		<Group id="35" groupID="17"/>
		<Group id="36" groupID="18"/>
		<Group id="37" groupID="19"/>
		<Group id="38" groupID="20"/>
	</SecurityGroups>
	<Events>
		<Event name="BeforeOutput" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="51"/>
			</Actions>
		</Event>
	</Events>
	<CachingParameters/>
	<Attributes/>
	<Features/>
</Page>

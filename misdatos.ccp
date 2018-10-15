<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" needGeneration="0" wizardTheme="InLine" wizardThemeType="File" cachingEnabled="False" cachingDuration="1 minutes" isService="False">
	<Components>
		<Record id="2" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="True" allowDelete="False" validateData="True" preserveParameters="GET" debugMode="False" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="Datos" name="usuarios" dataSource="usuarios" errorSummator="Error" wizardCaption="Agregar/Editar Usuarios " wizardTheme="Inline" wizardThemeType="File" wizardFormMethod="post" returnPage="menu_principal.ccp" activeCollection="TableParameters" activeTableType="dataSource" PathID="usuarios">
			<Components>
				<TextBox id="7" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="nom_usuario" fieldSource="nom_usuario" caption="Nom Usuario" wizardCaption="Nom Usuario" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" required="True" unique="True" visible="Yes" PathID="usuariosnom_usuario">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="8" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="log_usuario" fieldSource="log_usuario" caption="Log Usuario" wizardCaption="Log Usuario" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" required="True" unique="True" visible="Yes" PathID="usuarioslog_usuario">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="11" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="firma_nombre" fieldSource="firma_nombre" caption="Firma Nombre" wizardCaption="Firma Nombre" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" required="True" visible="Yes" PathID="usuariosfirma_nombre">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="13" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="firma_titulo" fieldSource="firma_titulo" required="False" caption="Firma Titulo" wizardCaption="Firma Titulo" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" visible="Yes" PathID="usuariosfirma_titulo">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<FileUpload id="16" fieldSourceType="DBColumn" allowedFileMasks="*.bmp" fileSizeLimit="100000" dataType="Text" tempFileFolder="TEMP" name="firma_imagen" wizardTheme="Inline" wizardThemeType="File" disallowedFileMasks="*.php;*.htm;*.jpg;*.gif" fieldSource="firma_imagen" caption="Imágen de la firma" processedFileFolder="firmas" PathID="usuariosfirma_imagen">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</FileUpload>
				<Label id="36" fieldSourceType="DBColumn" dataType="Text" html="True" editable="False" name="lblfirma" wizardTheme="Inline" wizardThemeType="File">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="37"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Button id="3" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Grabar" PathID="usuariosButton_Update">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="4" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Cancelar" PathID="usuariosButton_Cancel">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="5" conditionType="Parameter" useIsNull="False" field="usuario_id" parameterSource="CCGetUserID()" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="Expression" orderNumber="1" defaultValue="0"/>
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
		<CodeFile id="Code" language="PHPTemplates" name="misdatos.php" comment="//" codePage="utf-8" forShow="True" url="misdatos.php"/>
		<CodeFile id="Events" language="PHPTemplates" forShow="False" name="misdatos_events.php" codePage="utf-8" comment="//"/>
	</CodeFiles>
	<SecurityGroups>
		<Group id="17" groupID="3"/>
		<Group id="18" groupID="4"/>
		<Group id="19" groupID="5"/>
		<Group id="20" groupID="6"/>
		<Group id="21" groupID="7"/>
		<Group id="22" groupID="8"/>
		<Group id="23" groupID="9"/>
		<Group id="24" groupID="10"/>
		<Group id="25" groupID="11"/>
		<Group id="26" groupID="12"/>
		<Group id="27" groupID="13"/>
		<Group id="28" groupID="14"/>
		<Group id="29" groupID="15"/>
		<Group id="30" groupID="16"/>
		<Group id="31" groupID="17"/>
		<Group id="32" groupID="18"/>
		<Group id="33" groupID="19"/>
		<Group id="34" groupID="20"/>
	</SecurityGroups>
	<Events>
		<Event name="BeforeOutput" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="38"/>
			</Actions>
		</Event>
	</Events>
	<CachingParameters/>
	<Attributes/>
	<Features/>
</Page>

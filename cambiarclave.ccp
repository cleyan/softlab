<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" wizardTheme="InLine" wizardThemeType="File" cachingEnabled="False" cachingDuration="1 minutes" needGeneration="0" isService="False">
	<Components>
		<Record id="2" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="True" allowDelete="False" validateData="True" preserveParameters="GET" debugMode="False" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="Datos" name="usuarios" dataSource="usuarios" errorSummator="Error" wizardCaption="Agregar/Editar Usuarios " wizardTheme="Inline" wizardThemeType="File" wizardFormMethod="post" returnPage="menu_principal.ccp" activeCollection="TableParameters" activeTableType="dataSource" PathID="usuarios">
			<Components>
				<Label id="6" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nom_usuario" fieldSource="nom_usuario" required="False" caption="Nom Usuario" wizardCaption="Nom Usuario" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="7" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="log_usuario" fieldSource="log_usuario" required="False" caption="Log Usuario" wizardCaption="Log Usuario" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<TextBox id="8" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="clave_actual" caption="Clave actual" wizardCaption="Clave" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" required="True" visible="Yes" PathID="usuariosclave_actual">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="9" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="nueva_clave" wizardTheme="Inline" wizardThemeType="File" required="True" caption="Nueva Clave" visible="Yes" PathID="usuariosnueva_clave">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="10" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="nueva_clave2" wizardTheme="Inline" wizardThemeType="File" required="True" caption="Repetir NUeva clave" visible="Yes" PathID="usuariosnueva_clave2">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
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
			<Events>
				<Event name="BeforeUpdate" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="11"/>
					</Actions>
				</Event>
			</Events>
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
		<CodeFile id="Code" language="PHPTemplates" name="cambiarclave.php" comment="//" codePage="utf-8" forShow="True" url="cambiarclave.php"/>
		<CodeFile id="Events" language="PHPTemplates" forShow="False" name="cambiarclave_events.php" codePage="utf-8" comment="//"/>
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

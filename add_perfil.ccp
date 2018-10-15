<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" wizardTheme="InLine" wizardThemeType="File" needGeneration="0" cachingEnabled="False" cachingDuration="1 minutes" isService="False">
	<Components>
		<Record id="2" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" debugMode="False" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="Datos" name="perfiles" dataSource="perfiles" errorSummator="Error" wizardCaption="Agregar/Editar Perfiles " wizardTheme="Inline" wizardThemeType="File" wizardFormMethod="post" returnPage="add_perfil.ccp" activeCollection="TableParameters" activeTableType="dataSource" PathID="perfiles">
			<Components>
				<Hidden id="9" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="perfil_id" fieldSource="perfil_id" required="False" caption="Perfil Id" wizardCaption="Perfil Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="perfilesperfil_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="10" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="nom_perfil" fieldSource="nom_perfil" required="True" caption="nombre perfil" wizardCaption="Nom Perfil" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False" visible="Yes" PathID="perfilesnom_perfil">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Button id="3" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Agregar" PathID="perfilesButton_Insert">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="11" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" wizardTheme="Inline" wizardThemeType="File" operation="Update" PathID="perfilesButton_Update">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="7" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Cancelar" PathID="perfilesButton_Cancel">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
			</Components>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="16"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="8" conditionType="Parameter" useIsNull="False" field="perfil_id" parameterSource="perfil_id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1"/>
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
			<UConditions>
				<TableParameter id="12" conditionType="Parameter" useIsNull="False" field="perfil_id" dataType="Integer" parameterType="URL" parameterSource="perfil_id" searchConditionType="Equal" logicOperator="And" orderNumber="1"/>
			</UConditions>
			<UFormElements>
				<CustomParameter id="13" field="perfil_id" dataType="Integer" parameterType="Control" parameterSource="perfil_id"/>
				<CustomParameter id="14" field="nom_perfil" dataType="Text" parameterType="Control" parameterSource="nom_perfil"/>
			</UFormElements>
			<DSPParameters/>
			<DSQLParameters/>
			<DConditions>
				<TableParameter id="15" conditionType="Parameter" useIsNull="False" field="perfil_id" dataType="Integer" parameterType="URL" parameterSource="perfil_id" searchConditionType="Equal" logicOperator="And" orderNumber="1"/>
			</DConditions>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
			<PKFields/>
		</Record>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="add_perfil.php" comment="//" codePage="utf-8" forShow="True" url="add_perfil.php"/>
		<CodeFile id="Events" language="PHPTemplates" forShow="False" name="add_perfil_events.php" codePage="utf-8" comment="//"/>
	</CodeFiles>
	<SecurityGroups/>
	<Events>
		<Event name="BeforeOutput" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="17"/>
			</Actions>
		</Event>
	</Events>
	<CachingParameters/>
	<Attributes/>
	<Features/>
</Page>

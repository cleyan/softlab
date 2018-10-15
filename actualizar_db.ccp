<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" wizardTheme="InLine" wizardThemeType="File" needGeneration="0" accessDeniedPage="error_nivel.ccp" cachingEnabled="False" cachingDuration="1 minutes" isService="False">
	<Components>
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" debugMode="False" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="NewRecord1" wizardTheme="InLine" wizardThemeType="File" actionPage="aa" errorSummator="Error" wizardFormMethod="post" PathID="NewRecord1">
			<Components>
				<FileUpload id="10" fieldSourceType="DBColumn" allowedFileMasks="*.upd" fileSizeLimit="1000000" dataType="Text" tempFileFolder="TEMP" name="archivo" wizardTheme="InLine" wizardThemeType="File" disallowedFileMasks="*.php;*.htm;*.html;*.js" PathID="NewRecord1archivo">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</FileUpload>
				<CheckBox id="4" fieldSourceType="DBColumn" dataType="Boolean" editable="True" name="importar" wizardTheme="None" wizardThemeType="File" checkedValue="'V'" uncheckedValue="'F'" visible="Yes" PathID="NewRecord1importar" defaultValue="Unchecked">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</CheckBox>
				<Button id="5" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" wizardTheme="None" wizardThemeType="File" operation="Insert" wizardCaption="Agregar" PathID="NewRecord1Button_Insert">
					<Components/>
					<Events>
						<Event name="OnClick" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="8"/>
							</Actions>
						</Event>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Confirmation Message" actionCategory="General" id="9" message="Esta Seguro, esto podría Danar su BAse de Datos en forma ireversible"/>
							</Actions>
						</Event>
					</Events>
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
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="actualizar_db.php" comment="//" codePage="utf-8" forShow="True" url="actualizar_db.php"/>
		<CodeFile id="Events" language="PHPTemplates" forShow="False" name="actualizar_db_events.php" codePage="utf-8" comment="//"/>
	</CodeFiles>
	<SecurityGroups>
		<Group id="11" groupID="17"/>
		<Group id="12" groupID="18"/>
		<Group id="13" groupID="19"/>
		<Group id="14" groupID="20"/>
	</SecurityGroups>
	<Events>
		<Event name="BeforeOutput" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="15"/>
			</Actions>
		</Event>
	</Events>
	<CachingParameters/>
	<Attributes/>
	<Features/>
</Page>

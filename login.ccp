<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" needGeneration="0" wizardTheme="None" wizardThemeType="File" cachingEnabled="False" cachingDuration="1 minutes" isService="False">
	<Components>
		<Record id="2" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" debugMode="False" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="Login" wizardCaption="Login" wizardTheme="Inline" wizardThemeType="File" wizardOrientation="Vertical" wizardFormMethod="post" PathID="Login">
			<Components>
				<TextBox id="5" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="login" fieldSource="log_usuario" required="True" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Login" wizardSize="20" wizardMaxLength="100" wizardIsPassword="False" caption="Usuario" visible="Yes" PathID="Loginlogin">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="6" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="password" fieldSource="clave" required="True" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Password" wizardSize="20" wizardMaxLength="100" wizardIsPassword="True" caption="Contraseña" visible="Yes" PathID="Loginpassword">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Button id="3" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoLogin" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Login" returnPage="inicio.ccp" PathID="LoginButton_DoLogin">
					<Components/>
					<Events>
						<Event name="OnClick" type="Server">
							<Actions>
								<Action actionName="Login" actionCategory="Security" id="4" redirectToPreviousPage="True" loginParameter="login" passwordParameter="password"/>
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
		<CodeFile id="Code" language="PHPTemplates" name="login.php" comment="//" codePage="utf-8" forShow="True" url="login.php"/>
		<CodeFile id="Events" language="PHPTemplates" forShow="False" name="login_events.php" codePage="utf-8" comment="//"/>
	</CodeFiles>
	<SecurityGroups/>
	<Events>
		<Event name="OnLoad" type="Client">
			<Actions>
				<Action actionName="Set Focus" actionCategory="General" id="7" form="Login" name="login"/>
			</Actions>
		</Event>
		<Event name="AfterInitialize" type="Server">
			<Actions>
				<Action actionName="Logout" actionCategory="Security" id="8" pageRedirects="True" parameterName="Logout" returnPage="login.ccp"/>
				<Action actionName="Custom Code" actionCategory="General" id="9"/>
			</Actions>
		</Event>
		<Event name="BeforeOutput" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="10"/>
			</Actions>
		</Event>
	</Events>
	<CachingParameters/>
	<Attributes/>
	<Features/>
</Page>

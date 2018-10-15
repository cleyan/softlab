<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" wizardTheme="InLine" wizardThemeType="File" needGeneration="0" cachingEnabled="False" cachingDuration="1 minutes" isService="False">
	<Components>
		<Record id="2" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" debugMode="False" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="fechaSistema" wizardTheme="Inline" wizardThemeType="File" actionPage="cfgFechaSistema" errorSummator="Error" wizardFormMethod="post" wizardUseTemplateBlock="False" returnPage="menu_principal.ccp" PathID="fechaSistema">
			<Components>
				<Label id="8" fieldSourceType="DBColumn" dataType="Date" html="False" editable="False" name="viejaFechaSistema" wizardTheme="Inline" wizardThemeType="File" format="dd/mm/yyyy" defaultValue="GetFechaSistema()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<TextBox id="4" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="nuevafechasistema" wizardTheme="Inline" wizardThemeType="File" visible="Yes" PathID="fechaSistemanuevafechasistema">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Button id="9" urlType="Relative" enableValidation="True" isDefault="False" name="Actualizar" wizardTheme="Inline" wizardThemeType="File" operation="Search" returnPage="info_top.ccp" PathID="fechaSistemaActualizar">
					<Components/>
					<Events>
						<Event name="OnClick" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="11"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="10" urlType="Relative" enableValidation="True" isDefault="False" name="Cancelar" wizardTheme="Inline" wizardThemeType="File" operation="Cancel" PathID="fechaSistemaCancelar">
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
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="cfgFechaSistema_events.php" comment="//" codePage="utf-8" forShow="False"/>
		<CodeFile id="Code" language="PHPTemplates" name="cfgFechaSistema.php" comment="//" codePage="utf-8" forShow="True" url="cfgFechaSistema.php"/>
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

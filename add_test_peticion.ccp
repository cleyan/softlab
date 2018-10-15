<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" wizardTheme="InLine" wizardThemeType="File" cachingEnabled="False" cachingDuration="1 minutes" needGeneration="0" isService="False">
	<Components>
		<Label id="2" fieldSourceType="DBColumn" dataType="Text" html="True" editable="False" name="lista_de_test" wizardTheme="InLine" wizardThemeType="File">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Label>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="add_test_peticion.php" comment="//" codePage="utf-8" forShow="True" url="add_test_peticion.php"/>
		<CodeFile id="Events" language="PHPTemplates" forShow="False" name="add_test_peticion_events.php" codePage="utf-8" comment="//"/>
	</CodeFiles>
	<SecurityGroups/>
	<Events>
		<Event name="BeforeShow" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="3"/>
			</Actions>
		</Event>
		<Event name="BeforeOutput" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="4"/>
			</Actions>
		</Event>
	</Events>
	<CachingParameters/>
	<Attributes/>
	<Features/>
</Page>

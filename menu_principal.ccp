<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" needGeneration="0" cachingEnabled="False" cachingDuration="1 minutes" isService="False">
	<Components>
		<Label id="15" fieldSourceType="DBColumn" dataType="Text" html="True" name="acecade" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Label>
		<Label id="13" fieldSourceType="DBColumn" dataType="Text" html="True" editable="False" name="lbl_espere" wizardTheme="None" wizardThemeType="File">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Label>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="menu_principal.php" comment="//" codePage="utf-8" forShow="True" url="menu_principal.php"/>
		<CodeFile id="Events" language="PHPTemplates" forShow="False" name="menu_principal_events.php" codePage="utf-8" comment="//"/>
	</CodeFiles>
	<SecurityGroups/>
	<Events>
		<Event name="BeforeOutput" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="14"/>
			</Actions>
		</Event>
	</Events>
	<CachingParameters/>
	<Attributes/>
	<Features/>
</Page>

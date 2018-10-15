<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" needGeneration="0" cachingEnabled="False" cachingDuration="1 minutes" isService="False">
	<Components>
		<Label id="2" fieldSourceType="DBColumn" dataType="Text" html="True" editable="False" name="lbl_registrado" wizardTheme="None" wizardThemeType="File">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Label>
		<Label id="3" fieldSourceType="DBColumn" dataType="Text" html="True" editable="False" name="lbl_serie" wizardTheme="None" wizardThemeType="File">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Label>
		<Label id="10" fieldSourceType="DBColumn" dataType="Text" html="True" editable="False" name="lbl_version" wizardTheme="None" wizardThemeType="File">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Label>
		<Label id="5" fieldSourceType="DBColumn" dataType="Text" html="True" editable="False" name="lbl_usuario" wizardTheme="None" wizardThemeType="File">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Label>
		<Label id="4" fieldSourceType="DBColumn" dataType="Text" html="True" editable="False" name="lbl_distribuidor" wizardTheme="None" wizardThemeType="File">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Label>
		<Label id="6" fieldSourceType="DBColumn" dataType="Text" html="True" editable="False" name="lbl_sw_servidor" wizardTheme="None" wizardThemeType="File">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Label>
		<Label id="7" fieldSourceType="DBColumn" dataType="Text" html="True" editable="False" name="lbl_mysql" wizardTheme="None" wizardThemeType="File">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Label>
		<Label id="8" fieldSourceType="DBColumn" dataType="Text" html="True" editable="False" name="lbl_servidor" wizardTheme="None" wizardThemeType="File">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Label>
		<Label id="9" fieldSourceType="DBColumn" dataType="Text" html="True" editable="False" name="lbl_ip" wizardTheme="None" wizardThemeType="File">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Label>
		<Label id="11" fieldSourceType="DBColumn" dataType="Text" html="True" editable="False" name="info_distribuidor" wizardTheme="None" wizardThemeType="File">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Label>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="acercade.php" comment="//" codePage="utf-8" forShow="True" url="acercade.php"/>
		<CodeFile id="Events" language="PHPTemplates" forShow="False" name="acercade_events.php" codePage="utf-8" comment="//"/>
	</CodeFiles>
	<SecurityGroups/>
	<Events>
		<Event name="AfterInitialize" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="12"/>
			</Actions>
		</Event>
		<Event name="BeforeOutput" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="13"/>
			</Actions>
		</Event>
	</Events>
	<CachingParameters/>
	<Attributes/>
	<Features/>
</Page>

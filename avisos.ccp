<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="True" SSLAccess="False" needGeneration="0" cachingEnabled="False" cachingDuration="1 minutes" isService="False" PathID="avisos">
	<Components>
		<Label id="2" fieldSourceType="DBColumn" dataType="Text" html="True" editable="False" name="lbl_aviso" wizardTheme="None" wizardThemeType="File">
			<Components/>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="3"/>
					</Actions>
				</Event>
			</Events>
			<Attributes/>
			<Features/>
		</Label>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="avisos.php" comment="//" forShow="True" url="avisos.php" codePage="utf-8"/>
		<CodeFile id="Events" language="PHPTemplates" forShow="False" name="avisos_events.php" comment="//" codePage="utf-8"/>
	</CodeFiles>
	<SecurityGroups/>
	<Events>
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

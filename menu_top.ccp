<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" needGeneration="0" accessDeniedPage="error_nivel.ccp" cachingEnabled="False" cachingDuration="1 minutes" isService="False">
	<Components>
		<Label id="4" fieldSourceType="DBColumn" dataType="Text" html="True" editable="False" name="lblMenu" wizardTheme="None" wizardThemeType="File">
			<Components/>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="5"/>
					</Actions>
				</Event>
			</Events>
			<Attributes/>
			<Features/>
		</Label>
		<Label id="2" fieldSourceType="DBColumn" dataType="Text" html="True" editable="False" name="usuario" wizardTheme="None" wizardThemeType="File">
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
		<CodeFile id="Code" language="PHPTemplates" name="menu_top.php" comment="//" codePage="utf-8" forShow="True" url="menu_top.php"/>
		<CodeFile id="Events" language="PHPTemplates" forShow="False" name="menu_top_events.php" codePage="utf-8" comment="//"/>
	</CodeFiles>
	<SecurityGroups>
		<Group id="6" groupID="2"/>
		<Group id="7" groupID="3"/>
		<Group id="8" groupID="4"/>
		<Group id="9" groupID="5"/>
		<Group id="10" groupID="6"/>
		<Group id="11" groupID="7"/>
		<Group id="12" groupID="8"/>
		<Group id="13" groupID="9"/>
		<Group id="14" groupID="10"/>
		<Group id="15" groupID="11"/>
		<Group id="16" groupID="12"/>
		<Group id="17" groupID="13"/>
		<Group id="18" groupID="14"/>
		<Group id="19" groupID="15"/>
		<Group id="20" groupID="16"/>
		<Group id="21" groupID="17"/>
		<Group id="22" groupID="18"/>
		<Group id="23" groupID="19"/>
		<Group id="24" groupID="20"/>
	</SecurityGroups>
	<Events>
		<Event name="BeforeOutput" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="25"/>
			</Actions>
		</Event>
	</Events>
	<CachingParameters/>
	<Attributes/>
	<Features/>
</Page>

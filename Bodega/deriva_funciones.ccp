<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\Bodega" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" needGeneration="0" cachingEnabled="False" cachingDuration="1 minutes" isService="False">
	<Components>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="deriva_funciones.php" comment="//" codePage="utf-8" forShow="True" url="deriva_funciones.php"/>
		<CodeFile id="Events" language="PHPTemplates" forShow="False" name="deriva_funciones_events.php" codePage="utf-8" comment="//"/>
	</CodeFiles>
	<SecurityGroups/>
	<Events>
		<Event name="AfterInitialize" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="2"/>
			</Actions>
		</Event>
		<Event name="BeforeOutput" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="3"/>
			</Actions>
		</Event>
	</Events>
	<CachingParameters/>
	<Attributes/>
	<Features/>
</Page>

<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" needGeneration="0" accessDeniedPage="error_nivel.ccp" wizardTheme="InLine" wizardThemeType="File" cachingEnabled="False" cachingDuration="1 minutes" isService="False">
	<Components>
		<Label id="15" fieldSourceType="DBColumn" dataType="Integer" html="False" name="peticion_id" wizardTheme="InLine" wizardThemeType="File">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Label>
		<Link id="16" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="Link1" wizardTheme="InLine" wizardThemeType="File" hrefSource="del_peticion.ccp" wizardUseTemplateBlock="False" PathID="Link1">
			<Components/>
			<Events/>
			<LinkParameters>
				<LinkParameter id="17" sourceType="URL" format="yyyy-mm-dd" name="peticion_id" source="peticion_id"/>
				<LinkParameter id="23" sourceType="Expression" name="accion" source="&quot;eliminar&quot;"/>
			</LinkParameters>
			<Attributes/>
			<Features/>
		</Link>
		<Link id="24" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="Link2" wizardTheme="InLine" wizardThemeType="File" hrefSource="det_Peticion.ccp" wizardUseTemplateBlock="False" PathID="Link2">
			<Components/>
			<Events/>
			<LinkParameters>
				<LinkParameter id="25" sourceType="URL" format="yyyy-mm-dd" name="peticion_id" source="peticion_id"/>
			</LinkParameters>
			<Attributes/>
			<Features/>
		</Link>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="del_peticion.php" comment="//" codePage="utf-8" forShow="True" url="del_peticion.php"/>
		<CodeFile id="Events" language="PHPTemplates" forShow="False" name="del_peticion_events.php" codePage="utf-8" comment="//"/>
	</CodeFiles>
	<SecurityGroups>
		<Group id="18" groupID="16"/>
		<Group id="19" groupID="17"/>
		<Group id="20" groupID="18"/>
		<Group id="21" groupID="20"/>
	</SecurityGroups>
	<Events>
		<Event name="BeforeOutput" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="14"/>
			</Actions>
		</Event>
		<Event name="AfterInitialize" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="22"/>
			</Actions>
		</Event>
	</Events>
	<CachingParameters/>
	<Attributes/>
	<Features/>
</Page>

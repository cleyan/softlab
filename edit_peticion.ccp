<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" wizardTheme="InLine" wizardThemeType="File" needGeneration="0" accessDeniedPage="error_nivel.ccp" cachingEnabled="False" cachingDuration="1 minutes" isService="False">
	<Components>
		<Label id="24" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="status_peticion" wizardTheme="InLine" wizardThemeType="File">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Label>
		<Label id="15" fieldSourceType="DBColumn" dataType="Text" html="True" editable="False" name="mensajes" wizardTheme="InLine" wizardThemeType="File">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Label>
		<Label id="13" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nom_paciente" wizardTheme="InLine" wizardThemeType="File">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Label>
		<Label id="12" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="paciente_id" wizardTheme="InLine" wizardThemeType="File">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Label>
		<Label id="8" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="False" name="estado_id" wizardTheme="InLine" wizardThemeType="File">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Label>
		<Label id="25" fieldSourceType="DBColumn" dataType="Text" html="True" editable="False" name="peticion_id" wizardTheme="InLine" wizardThemeType="File">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Label>
		<Label id="9" fieldSourceType="DBColumn" dataType="Text" html="True" editable="False" name="fecha" wizardTheme="InLine" wizardThemeType="File">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Label>
		<Label id="10" fieldSourceType="DBColumn" dataType="Text" html="True" editable="False" name="hora" wizardTheme="InLine" wizardThemeType="File">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Label>
		<Label id="42" fieldSourceType="DBColumn" dataType="Text" html="True" name="opPrevision" wizardTheme="InLine" wizardThemeType="File">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Label>
		<Label id="40" fieldSourceType="DBColumn" dataType="Text" html="True" name="opMedico" wizardTheme="InLine" wizardThemeType="File">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Label>
		<Label id="41" fieldSourceType="DBColumn" dataType="Text" html="True" name="valorOp" wizardTheme="InLine" wizardThemeType="File">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Label>
		<Label id="43" fieldSourceType="DBColumn" dataType="Text" html="True" name="opPrioridad" wizardTheme="InLine" wizardThemeType="File">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Label>
		<Label id="44" fieldSourceType="DBColumn" dataType="Text" html="True" name="op_seccion_id" wizardTheme="InLine" wizardThemeType="File">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Label>
		<Label id="4" fieldSourceType="DBColumn" dataType="Text" html="True" editable="False" name="lblTest" wizardTheme="InLine" wizardThemeType="File">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Label>
		<Label id="5" fieldSourceType="DBColumn" dataType="Text" html="True" editable="False" name="listaTest" wizardTheme="InLine" wizardThemeType="File">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Label>
		<Label id="17" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="observaciones" wizardTheme="InLine" wizardThemeType="File">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Label>
		<Label id="6" fieldSourceType="DBColumn" dataType="Text" html="True" editable="False" name="restoTest" wizardTheme="InLine" wizardThemeType="File">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Label>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="edit_peticion.php" comment="//" codePage="utf-8" forShow="True" url="edit_peticion.php"/>
		<CodeFile id="Events" language="PHPTemplates" forShow="False" name="edit_peticion_events.php" codePage="utf-8" comment="//"/>
	</CodeFiles>
	<SecurityGroups>
		<Group id="28" groupID="4"/>
		<Group id="29" groupID="5"/>
		<Group id="30" groupID="12"/>
		<Group id="31" groupID="13"/>
		<Group id="32" groupID="14"/>
		<Group id="33" groupID="15"/>
		<Group id="34" groupID="16"/>
		<Group id="35" groupID="17"/>
		<Group id="36" groupID="18"/>
		<Group id="37" groupID="19"/>
		<Group id="38" groupID="20"/>
	</SecurityGroups>
	<Events>
		<Event name="BeforeShow" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="3"/>
			</Actions>
		</Event>
		<Event name="AfterInitialize" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="11"/>
			</Actions>
		</Event>
		<Event name="BeforeOutput" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="39"/>
			</Actions>
		</Event>
	</Events>
	<CachingParameters/>
	<Attributes/>
	<Features/>
</Page>

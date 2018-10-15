<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" wizardTheme="InLine" wizardThemeType="File" needGeneration="0" accessDeniedPage="error_nivel.ccp" cachingEnabled="False" cachingDuration="1 minutes" isService="False">
	<Components>
		<Record id="2" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" debugMode="False" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="filtro" wizardCaption="Buscar  " wizardTheme="Inline" wizardThemeType="File" wizardOrientation="Vertical" wizardFormMethod="post" returnPage="add_resultados_peticion2.ccp" PathID="filtro">
			<Components>
				<TextBox id="4" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="s_peticion_id" wizardCaption="Peticion Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" visible="Yes" PathID="filtros_peticion_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Button id="3" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Buscar" PathID="filtroButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
			</Components>
			<Events>
				<Event name="OnValidate" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="15"/>
					</Actions>
				</Event>
			</Events>
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
		<Record id="5" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" debugMode="False" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="grilla" wizardTheme="InLine" wizardThemeType="File" actionPage="add_resultados_peticion2" errorSummator="Error" wizardFormMethod="post" returnPage="add_resultados_peticion2.ccp" PathID="grilla">
			<Components>
				<TextBox id="13" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="peticion_id" wizardTheme="InLine" wizardThemeType="File" visible="Yes" PathID="grillapeticion_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Label id="11" fieldSourceType="DBColumn" dataType="Text" html="True" editable="False" name="inf_peticion" wizardTheme="InLine" wizardThemeType="File">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="12" fieldSourceType="DBColumn" dataType="Text" html="True" editable="False" name="grilla_peticiones" wizardTheme="InLine" wizardThemeType="File">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<TextBox id="17" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="filas" wizardTheme="InLine" wizardThemeType="File" defaultValue="1" visible="Yes" PathID="grillafilas">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ImageLink id="20" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" editable="False" name="btn_validar" wizardTheme="InLine" wizardThemeType="File" hrefSource="validar_resultados_peticion.ccp" visible="Yes" PathID="grillabtn_validar">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="21" sourceType="URL" name="s_peticion_id" source="s_peticion_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</ImageLink>
				<ImageLink id="35" visible="Yes" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" name="ImageLink1" wizardTheme="InLine" wizardThemeType="File" hrefSource="det_Peticion.ccp" PathID="grillaImageLink1">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="36" sourceType="URL" format="yyyy-mm-dd" name="peticion_id" source="s_peticion_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</ImageLink>
				<ImageLink id="37" visible="Yes" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" name="ImageLink2" wizardTheme="InLine" wizardThemeType="File" hrefSource="edit_peticion.ccp" PathID="grillaImageLink2">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="38" sourceType="URL" format="yyyy-mm-dd" name="peticion_id" source="s_peticion_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</ImageLink>
			</Components>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="14"/>
					</Actions>
				</Event>
				<Event name="BeforeSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="22"/>
					</Actions>
				</Event>
			</Events>
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
		<CodeFile id="Code" language="PHPTemplates" name="add_resultados_peticion2.php" comment="//" codePage="utf-8" forShow="True" url="add_resultados_peticion2.php"/>
		<CodeFile id="Events" language="PHPTemplates" forShow="False" name="add_resultados_peticion2_events.php" codePage="utf-8" comment="//"/>
	</CodeFiles>
	<SecurityGroups>
		<Group id="23" groupID="5"/>
		<Group id="24" groupID="11"/>
		<Group id="25" groupID="12"/>
		<Group id="26" groupID="13"/>
		<Group id="27" groupID="14"/>
		<Group id="28" groupID="15"/>
		<Group id="29" groupID="16"/>
		<Group id="30" groupID="17"/>
		<Group id="31" groupID="18"/>
		<Group id="32" groupID="19"/>
		<Group id="33" groupID="20"/>
	</SecurityGroups>
	<Events>
		<Event name="BeforeOutput" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="34"/>
			</Actions>
		</Event>
	</Events>
	<CachingParameters/>
	<Attributes/>
	<Features/>
</Page>

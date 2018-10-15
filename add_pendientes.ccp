<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" wizardTheme="InLine" wizardThemeType="File" needGeneration="0" cachingEnabled="False" cachingDuration="1 minutes" isService="False">
	<Components>
		<Record id="18" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="GET" debugMode="False" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="Datos" name="bitacora" dataSource="bitacora" errorSummator="Error" wizardCaption="Agregar/Editar Bitacora " wizardTheme="Inline" wizardThemeType="File" wizardFormMethod="post" returnPage="closeandrefresh.ccp" customInsertType="Table" activeCollection="IFormElements" activeTableType="bitacora" customInsert="bitacora" PathID="bitacora">
			<Components>
				<Label id="23" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="peticion_id" fieldSource="peticion_id" required="True" caption="Peticion Id" wizardCaption="Peticion Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<TextBox id="24" fieldSourceType="DBColumn" dataType="Date" html="False" editable="True" hasErrorCollection="True" name="fecha" fieldSource="fecha" required="True" caption="Fecha" wizardCaption="Fecha" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" format="dd/mm/yyyy" defaultValue="CurrentDate" DBFormat="yyyy-mm-dd HH:nn:ss" visible="Yes" PathID="bitacorafecha">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextArea id="26" fieldSourceType="DBColumn" dataType="Memo" html="False" editable="True" hasErrorCollection="True" name="descripcion" fieldSource="descripcion" required="True" caption="Descripcion" wizardCaption="Descripcion" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardRows="3" visible="Yes" PathID="bitacoradescripcion">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextArea>
				<Button id="19" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Agregar" PathID="bitacoraButton_Insert">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="21" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Cancelar" PathID="bitacoraButton_Cancel">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
			</Components>
			<Events>
			</Events>
			<TableParameters>
				<TableParameter id="22" conditionType="Parameter" useIsNull="False" field="bitacora_id" parameterSource="bitacora_id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<ISPParameters/>
			<ISQLParameters/>
			<IFormElements>
				<CustomParameter id="31" field="peticion_id" dataType="Integer" parameterType="URL" parameterSource="peticion_id"/>
				<CustomParameter id="32" field="fecha" dataType="Date" parameterType="Control" parameterSource="fecha"/>
				<CustomParameter id="33" field="descripcion" dataType="Memo" parameterType="Control" parameterSource="descripcion"/>
				<CustomParameter id="34" field="tipo_bitacora_id" dataType="Integer" parameterType="Expression" parameterSource="1"/>
				<CustomParameter id="35" field="usuario_id" dataType="Integer" parameterType="Expression" parameterSource="CCGetUserID()"/>
				<CustomParameter id="36" field="estado_id" dataType="Integer" parameterType="Expression" parameterSource="1000"/>
				<CustomParameter id="37" field="nivel_id" dataType="Integer" parameterType="Expression" parameterSource="2"/>
			</IFormElements>
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
		<IncludePage id="17" hasOperation="True" name="calendar_tag" wizardTheme="InLine" wizardThemeType="File" page="calendar_tag.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="add_pendientes.php" comment="//" codePage="utf-8" forShow="True" url="add_pendientes.php"/>
		<CodeFile id="Events" language="PHPTemplates" name="add_pendientes_events.php" forShow="False" comment="//" codePage="utf-8"/>
	</CodeFiles>
	<SecurityGroups/>
	<Events>
		<Event name="BeforeOutput" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="38"/>
			</Actions>
		</Event>
	</Events>
	<CachingParameters/>
	<Attributes/>
	<Features/>
</Page>

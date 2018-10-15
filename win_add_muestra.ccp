<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" wizardTheme="InLine" wizardThemeType="File" needGeneration="0" cachingEnabled="False" cachingDuration="1 minutes" isService="False">
	<Components>
		<Record id="2" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" debugMode="False" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="Datos" name="tipos_muestra" dataSource="tipos_muestra" errorSummator="Error" wizardCaption="Agregar/Editar Tipos Muestra " wizardTheme="Inline" wizardThemeType="File" wizardFormMethod="post" returnPage="win_add_muestra.ccp" PathID="tipos_muestra">
			<Components>
				<Hidden id="11" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="tipo_muestra_id" fieldSource="tipo_muestra_id" required="False" caption="Tipo Muestra Id" wizardCaption="Tipo Muestra Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="tipos_muestratipo_muestra_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="12" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="activo" fieldSource="activo" required="False" caption="Activo" wizardCaption="Activo" wizardTheme="Inline" wizardThemeType="File" wizardSize="1" wizardMaxLength="1" wizardIsPassword="False" wizardUseTemplateBlock="False" defaultValue="'V'" PathID="tipos_muestraactivo">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="14" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="muestra_last_id" wizardTheme="Inline" wizardThemeType="File" PathID="tipos_muestramuestra_last_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="15" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="last_nom_muestra" wizardTheme="Inline" wizardThemeType="File" PathID="tipos_muestralast_nom_muestra">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="9" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="nom_tipo_muestra" fieldSource="nom_tipo_muestra" required="True" caption="Tipo de Muestra" wizardCaption="Nom Tipo Muestra" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" visible="Yes" PathID="tipos_muestranom_tipo_muestra">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="10" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="indicacion_id" fieldSource="indicacion_id" required="True" caption="Indicación" wizardCaption="Indicacion Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" sourceType="Table" connection="Datos" dataSource="indicaciones_muestra" boundColumn="indicacion_muestra_id" textColumn="nom_indicacion" visible="Yes" PathID="tipos_muestraindicacion_id">
					<Components/>
					<Events/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
					<PKFields/>
				</ListBox>
				<Button id="3" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Agregar" returnPage="add_test.ccp" PathID="tipos_muestraButton_Insert">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="7" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Cancelar" PathID="tipos_muestraButton_Cancel">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="8" conditionType="Parameter" useIsNull="False" field="tipo_muestra_id" parameterSource="tipo_muestra_id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1"/>
			</TableParameters>
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
		<CodeFile id="Code" language="PHPTemplates" name="win_add_muestra.php" comment="//" codePage="utf-8" forShow="True" url="win_add_muestra.php"/>
		<CodeFile id="Events" language="PHPTemplates" name="win_add_muestra_events.php" forShow="False" comment="//" codePage="utf-8"/>
	</CodeFiles>
	<SecurityGroups/>
	<Events>
		<Event name="BeforeOutput" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="16"/>
			</Actions>
		</Event>
	</Events>
	<CachingParameters/>
	<Attributes/>
	<Features/>
</Page>

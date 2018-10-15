<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" wizardTheme="InLine" wizardThemeType="File" cachingEnabled="False" cachingDuration="1 minutes" needGeneration="0" isService="False">
	<Components>
		<Record id="2" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" debugMode="False" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="Datos" name="indicaciones_muestra" dataSource="indicaciones_muestra" errorSummator="Error" wizardCaption="Agregar/Editar Indicaciones Muestra " wizardTheme="Inline" wizardThemeType="File" wizardFormMethod="post" returnPage="win_add_indicacion_muestra.ccp" PathID="indicaciones_muestra">
			<Components>
				<Hidden id="12" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="activo" fieldSource="activo" required="False" caption="Activo" wizardCaption="Activo" wizardTheme="Inline" wizardThemeType="File" wizardSize="1" wizardMaxLength="1" wizardIsPassword="False" wizardUseTemplateBlock="False" defaultValue="'V'" PathID="indicaciones_muestraactivo">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="9" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="indicacion_muestra_id" fieldSource="indicacion_muestra_id" required="False" caption="Indicacion Muestra Id" wizardCaption="Indicacion Muestra Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="indicaciones_muestraindicacion_muestra_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="10" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="nom_indicacion" fieldSource="nom_indicacion" required="True" caption="Nombre descriptivo" wizardCaption="Nom Indicacion" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" visible="Yes" PathID="indicaciones_muestranom_indicacion">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextArea id="11" fieldSourceType="DBColumn" dataType="Memo" html="False" editable="True" hasErrorCollection="True" name="cuerpo_indicacion" fieldSource="cuerpo_indicacion" required="True" caption="Descripción" wizardCaption="Cuerpo Indicacion" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardRows="3" visible="Yes" PathID="indicaciones_muestracuerpo_indicacion">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextArea>
				<Button id="3" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Agregar" returnPage="win_add_muestra.ccp" PathID="indicaciones_muestraButton_Insert">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="7" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Cancelar" returnPage="win_add_muestra.ccp" PathID="indicaciones_muestraButton_Cancel">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="8" conditionType="Parameter" useIsNull="False" field="indicacion_muestra_id" parameterSource="indicacion_muestra_id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1"/>
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
		<CodeFile id="Code" language="PHPTemplates" name="win_add_indicacion_muestra.php" comment="//" codePage="utf-8" forShow="True" url="win_add_indicacion_muestra.php"/>
		<CodeFile id="Events" language="PHPTemplates" name="win_add_indicacion_muestra_events.php" forShow="False" comment="//" codePage="utf-8"/>
	</CodeFiles>
	<SecurityGroups/>
	<Events>
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

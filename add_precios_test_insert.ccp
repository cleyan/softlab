<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" wizardTheme="InLine" wizardThemeType="File" needGeneration="0" accessDeniedPage="error_nivel.ccp" cachingEnabled="False" cachingDuration="1 minutes" isService="False">
	<Components>
		<Record id="2" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" debugMode="False" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="Datos" name="precios_test" dataSource="precios_test" errorSummator="Error" wizardCaption="Agregar/Editar Precios Test " wizardTheme="Inline" wizardThemeType="File" wizardFormMethod="post" returnPage="add_precios_test_insert.ccp" PathID="precios_test">
			<Components>
				<ListBox id="12" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="prevision_aplicar_id" wizardTheme="Inline" wizardThemeType="File" sourceType="Table" caption="Previsión a aplicar" connection="Datos" dataSource="previsiones" boundColumn="prevision_id" activeCollection="TableParameters" activeTableType="dataSource" orderBy="nom_prevision" textColumn="nom_prevision" required="True" visible="Yes" PathID="precios_testprevision_aplicar_id">
					<Components/>
					<Events/>
					<TableParameters>
						<TableParameter id="14" conditionType="Parameter" useIsNull="False" field="activo" dataType="Text" searchConditionType="Equal" parameterType="URL" logicOperator="And" defaultValue="'V'" parameterSource="activo" orderNumber="1"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
					<PKFields/>
				</ListBox>
				<ListBox id="10" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="prevision_base_id" required="True" caption="Previsión base" wizardCaption="Prevision Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" sourceType="Table" connection="Datos" dataSource="previsiones" boundColumn="prevision_id" textColumn="nom_prevision" activeCollection="TableParameters" activeTableType="dataSource" orderBy="nom_prevision" visible="Yes" PathID="precios_testprevision_base_id">
					<Components/>
					<Events/>
					<TableParameters>
						<TableParameter id="13" conditionType="Parameter" useIsNull="False" field="activo" dataType="Text" searchConditionType="Equal" parameterType="URL" logicOperator="And" defaultValue="'V'" parameterSource="activo" orderNumber="1"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
					<PKFields/>
				</ListBox>
				<ListBox id="17" fieldSourceType="DBColumn" sourceType="Table" dataType="Integer" editable="True" hasErrorCollection="True" returnValueType="Number" name="procedencia_base_id" wizardTheme="Inline" wizardThemeType="File" wizardEmptyCaption="Seleccionar Valor" connection="Datos" dataSource="procedencias" boundColumn="procedencia_id" textColumn="nom_procedencia" visible="Yes" PathID="precios_testprocedencia_base_id">
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
				<TextBox id="11" fieldSourceType="DBColumn" dataType="Float" html="False" editable="True" hasErrorCollection="True" name="factor" wizardTheme="Inline" wizardThemeType="File" required="True" caption="Factor" sourceType="Table" visible="Yes" PathID="precios_testfactor">
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
				</TextBox>
				<ListBox id="9" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="procedencia_id" required="False" caption="Procedencia" wizardCaption="Procedencia Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" sourceType="Table" connection="Datos" dataSource="procedencias" boundColumn="procedencia_id" textColumn="nom_procedencia" activeCollection="TableParameters" activeTableType="dataSource" orderBy="nom_procedencia" defaultValue="0" visible="Yes" PathID="precios_testprocedencia_id">
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
				<Button id="3" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Agregar" PathID="precios_testButton_Insert">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="7" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Cancelar" PathID="precios_testButton_Cancel">
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
				<Event name="BeforeInsert" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="16"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="8" conditionType="Parameter" useIsNull="False" field="precio_test_id" parameterSource="precio_test_id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1"/>
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
		<CodeFile id="Code" language="PHPTemplates" name="add_precios_test_insert.php" comment="//" codePage="utf-8" forShow="True" url="add_precios_test_insert.php"/>
		<CodeFile id="Events" language="PHPTemplates" forShow="False" name="add_precios_test_insert_events.php" codePage="utf-8" comment="//"/>
	</CodeFiles>
	<SecurityGroups>
		<Group id="18" groupID="16"/>
		<Group id="19" groupID="17"/>
		<Group id="20" groupID="18"/>
		<Group id="21" groupID="19"/>
		<Group id="22" groupID="20"/>
	</SecurityGroups>
	<Events>
		<Event name="BeforeOutput" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="23"/>
			</Actions>
		</Event>
	</Events>
	<CachingParameters/>
	<Attributes/>
	<Features/>
</Page>

<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" wizardTheme="InLine" wizardThemeType="File" needGeneration="0" cachingEnabled="False" cachingDuration="1 minutes" isService="False">
	<Components>
		<EditableGrid id="2" urlType="Relative" secured="False" emptyRows="1" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" sourceType="Table" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="valores_resultado" connection="Datos" dataSource="valores_resultado" wizardCaption="Lista de Valores Resultado " wizardTheme="Inline" wizardThemeType="File" wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAltRecord="False" wizardRecordSeparator="False" deleteControl="CheckBox_Delete" activeCollection="IFormElements" activeTableType="valores_resultado" customInsertType="Table" customInsert="valores_resultado" PathID="valores_resultado">
			<Components>
				<Label id="20" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nom_test" wizardTheme="Inline" wizardThemeType="File">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="DLookup" actionCategory="Database" id="21" typeOfTarget="Control" expression="nom_test" domain="test" criteria="test_id=$test_id" connection="Datos" dataType="Text"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Sorter id="5" visible="True" name="Sorter_nom_resultado" column="nom_resultado" wizardCaption="Nom Resultado" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="nom_resultado" PathID="valores_resultadoSorter_nom_resultado">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<TextBox id="8" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="nom_resultado" fieldSource="nom_resultado" required="False" caption="Nom Resultado" wizardCaption="Nom Resultado" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" visible="Yes" PathID="valores_resultadonom_resultado">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<CheckBox id="10" fieldSourceType="CodeExpression" dataType="Boolean" editable="True" name="CheckBox_Delete" checkedValue="true" uncheckedValue="false" wizardCaption="Borrar" wizardTheme="Inline" wizardThemeType="File" wizardUseTemplateBlock="True" visible="Yes" PathID="valores_resultadoCheckBox_Delete" defaultValue="Unchecked">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</CheckBox>
				<Button id="12" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Submit" operation="Submit" wizardCaption="Grabar" wizardTheme="Inline" wizardThemeType="File" PathID="valores_resultadoButton_Submit">
					<Components/>
					<Events>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Confirmation Message" actionCategory="General" id="13" message="Enviar registro?"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="15" conditionType="Parameter" useIsNull="False" field="test_id" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" defaultValue="0" parameterSource="test_id" orderNumber="1"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<PKFields>
				<PKField id="3" tableName="valores_resultado" fieldName="valor_resultado_id" dataType="Integer"/>
			</PKFields>
			<ISPParameters/>
			<ISQLParameters/>
			<IFormElements>
				<CustomParameter id="16" field="nom_resultado" dataType="Text" parameterType="Control" parameterSource="nom_resultado"/>
				<CustomParameter id="18" field="test_id" dataType="Integer" parameterType="URL" parameterSource="test_id"/>
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
		</EditableGrid>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="add_list_resultados_events.php" comment="//" codePage="utf-8" forShow="False"/>
		<CodeFile id="Code" language="PHPTemplates" name="add_list_resultados.php" comment="//" codePage="utf-8" forShow="True" url="add_list_resultados.php"/>
	</CodeFiles>
	<SecurityGroups>
		<Group id="22" groupID="12"/>
		<Group id="23" groupID="13"/>
		<Group id="24" groupID="14"/>
		<Group id="25" groupID="15"/>
		<Group id="26" groupID="16"/>
		<Group id="27" groupID="17"/>
		<Group id="28" groupID="18"/>
		<Group id="29" groupID="19"/>
		<Group id="30" groupID="20"/>
	</SecurityGroups>
	<Events>
		<Event name="AfterInitialize" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="19"/>
			</Actions>
		</Event>
		<Event name="BeforeOutput" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="31"/>
			</Actions>
		</Event>
	</Events>
	<CachingParameters/>
	<Attributes/>
	<Features/>
</Page>

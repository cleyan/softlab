<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" wizardTheme="InLine" wizardThemeType="File" needGeneration="0" cachingEnabled="False" cachingDuration="1 minutes" isService="False">
	<Components>
		<Grid id="28" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="10" connection="Datos" name="informes" dataSource="informes" pageSizeLimit="100" wizardCaption="Lista de Informes " wizardTheme="Inline" wizardThemeType="File" wizardGridType="Tabular" wizardAllowInsert="False" wizardAltRecord="False" wizardRecordSeparator="False" activeCollection="TableParameters" activeTableType="dataSource" PathID="informes">
			<Components>
				<Label id="32" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="False" name="informe_id" fieldSource="informe_id" wizardCaption="Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="33" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nom_informe" fieldSource="nom_informe" wizardCaption="Nom Informe" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="34" conditionType="Parameter" useIsNull="False" field="informe_id" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" defaultValue="0" parameterSource="informe_id" orderNumber="1"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="29" tableName="informes" posWidth="184" posHeight="190" posLeft="10" posTop="10"/>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="30" tableName="informes" fieldName="informe_id"/>
				<Field id="31" tableName="informes" fieldName="nom_informe"/>
			</Fields>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
			<PKFields/>
		</Grid>
		<EditableGrid id="14" urlType="Relative" secured="False" emptyRows="1" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" sourceType="Table" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="informes_detalle1" connection="Datos" dataSource="informes_detalle, test" wizardCaption="Lista de Informes Detalle " wizardTheme="Inline" wizardThemeType="File" wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAltRecord="False" wizardRecordSeparator="False" deleteControl="CheckBox_Delete" customInsertType="Table" activeCollection="DConditions" activeTableType="customDelete" customInsert="informes_detalle" customUpdateType="Table" customUpdate="informes_detalle" wizardAllowSorting="True" customDeleteType="Table" customDelete="informes_detalle" PathID="informes_detalle1">
			<Components>
				<Sorter id="16" visible="True" name="Sorter_test_id" column="cod_test" wizardCaption="Test Id" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="test_id" PathID="informes_detalle1Sorter_test_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="46" visible="True" name="Nombre_largo" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="Simple" connection="Datos" column="nom_test" PathID="informes_detalle1Nombre_largo">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<ListBox id="17" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="test_id" fieldSource="test_id" caption="Test Id" wizardCaption="Test Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" sourceType="Table" connection="Datos" dataSource="test" boundColumn="test_id" textColumn="cod_test" orderBy="cod_test" activeCollection="TableParameters" activeTableType="dataSource" required="True" visible="Yes" PathID="informes_detalle1test_id">
					<Components/>
					<Events/>
					<TableParameters>
						<TableParameter id="26" conditionType="Parameter" useIsNull="True" field="aislado" dataType="Text" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="'V'" orderNumber="1"/>
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
				<Label id="55" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nom_test" wizardTheme="Inline" wizardThemeType="File" fieldSource="nom_test">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<CheckBox id="18" fieldSourceType="CodeExpression" dataType="Boolean" editable="True" name="CheckBox_Delete" checkedValue="true" uncheckedValue="false" wizardCaption="Borrar" wizardTheme="Inline" wizardThemeType="File" wizardUseTemplateBlock="True" visible="Yes" PathID="informes_detalle1CheckBox_Delete" defaultValue="Unchecked">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</CheckBox>
				<Button id="20" urlType="Relative" enableValidation="True" name="Button_Submit" operation="Submit" wizardCaption="Enviar" wizardTheme="Inline" wizardThemeType="File" isDefault="True" PathID="informes_detalle1Button_Submit">
					<Components/>
					<Events>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Confirmation Message" actionCategory="General" id="21" message="Enviar registro?"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="22" urlType="Relative" enableValidation="False" isDefault="False" name="Cancel" operation="Cancel" wizardCaption="Cancelar" wizardTheme="Inline" wizardThemeType="File" returnPage="def_informe.ccp" PathID="informes_detalle1Cancel">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
			</Components>
			<Events>
				<Event name="BeforeSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="27"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="25" conditionType="Parameter" useIsNull="False" field="informes_detalle.informe_id" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" defaultValue="0" parameterSource="informe_id" orderNumber="1"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables>
				<JoinTable id="47" tableName="informes_detalle" posWidth="163" posHeight="125" posLeft="40" posTop="11"/>
				<JoinTable id="50" tableName="test" posWidth="303" posHeight="480" posLeft="252" posTop="14"/>
			</JoinTables>
			<JoinLinks>
				<JoinTable2 id="54" fieldLeft="informes_detalle.test_id" fieldRight="test.test_id" tableLeft="informes_detalle" tableRight="test" conditionType="Equal" joinType="left"/>
			</JoinLinks>
			<Fields>
				<Field id="48" tableName="informes_detalle" fieldName="informes_detalle.*"/>
				<Field id="52" tableName="test" fieldName="cod_test"/>
				<Field id="53" tableName="test" fieldName="nom_test"/>
			</Fields>
			<PKFields>
			</PKFields>
			<ISPParameters/>
			<ISQLParameters/>
			<IFormElements>
				<CustomParameter id="23" field="test_id" dataType="Integer" parameterType="Control" parameterSource="test_id"/>
				<CustomParameter id="24" field="informe_id" dataType="Integer" parameterType="URL" parameterSource="informe_id"/>
			</IFormElements>
			<USPParameters/>
			<USQLParameters/>
			<UConditions>
				<TableParameter id="43" conditionType="Parameter" useIsNull="False" field="informe_id" dataType="Integer" parameterType="URL" parameterSource="informe_id" defaultValue="0" searchConditionType="Equal" logicOperator="And" orderNumber="1"/>
				<TableParameter id="45" conditionType="Parameter" useIsNull="False" field="detalle_informe_id" dataType="Integer" searchConditionType="Equal" parameterType="DataSourceColumn" logicOperator="And" parameterSource="detalle_informe_id"/>
			</UConditions>
			<UFormElements>
				<CustomParameter id="44" field="test_id" dataType="Integer" parameterType="Control" parameterSource="test_id"/>
			</UFormElements>
			<DSPParameters/>
			<DSQLParameters/>
			<DConditions>
				<TableParameter id="57" conditionType="Parameter" useIsNull="False" field="detalle_informe_id" dataType="Integer" searchConditionType="Equal" parameterType="DataSourceColumn" logicOperator="And" parameterSource="detalle_informe_id"/>
			</DConditions>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</EditableGrid>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="def_informe_detalle.php" comment="//" codePage="utf-8" forShow="True" url="def_informe_detalle.php"/>
		<CodeFile id="Events" language="PHPTemplates" forShow="False" name="def_informe_detalle_events.php" codePage="utf-8" comment="//"/>
	</CodeFiles>
	<SecurityGroups/>
	<Events>
		<Event name="BeforeOutput" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="58"/>
			</Actions>
		</Event>
	</Events>
	<CachingParameters/>
	<Attributes/>
	<Features/>
</Page>

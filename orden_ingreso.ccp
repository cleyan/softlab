<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" needGeneration="0" wizardTheme="InLine" wizardThemeType="File" accessDeniedPage="error_nivel.ccp" cachingEnabled="False" cachingDuration="1 minutes" isService="False">
	<Components>
		<EditableGrid id="2" urlType="Relative" secured="False" emptyRows="0" allowInsert="False" allowUpdate="True" allowDelete="False" validateData="True" preserveParameters="GET" sourceType="Table" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="Datos" dataSource="compuesto_detalle, test" name="compuesto_detalle_test" wizardCaption="Lista de Compuesto Detalle, Test " wizardTheme="Inline" wizardThemeType="File" wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAltRecord="False" wizardRecordSeparator="False" activeCollection="UConditions" activeTableType="customUpdate" orderBy="orden_ingreso" returnPage="add_compuesto_detalle.ccp" customUpdateType="Table" customUpdate="test" wizardAllowSorting="True" PathID="compuesto_detalle_test">
			<Components>
				<Label id="25" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="compuesto_detalle_test_TotalRecords" wizardTheme="Inline" wizardThemeType="File" wizardUseTemplateBlock="False">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Retrieve number of records" actionCategory="Database" id="26"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="57" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="Label1" wizardTheme="Inline" wizardThemeType="File">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="DLookup" actionCategory="Database" id="58" typeOfTarget="Control" expression="'nom_test'" domain="'test'" criteria="'test_id=' . CCGetParam('comp_test_id','0')" connection="Datos" dataType="Text" target="Label1"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Sorter id="30" visible="True" name="Sorter_cod_test" column="cod_test" wizardCaption="Cod Test" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="cod_test" PathID="compuesto_detalle_testSorter_cod_test">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="31" visible="True" name="Sorter_nom_test" column="nom_test" wizardCaption="Nom Test" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="nom_test" PathID="compuesto_detalle_testSorter_nom_test">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="32" visible="True" name="Sorter_orden_ingreso" column="orden_ingreso" wizardCaption="Orden Ingreso" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="orden_ingreso" PathID="compuesto_detalle_testSorter_orden_ingreso">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="59" visible="True" name="Orden_en_informe" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="Simple" column="orden_informe" PathID="compuesto_detalle_testOrden_en_informe">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Label id="36" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="cod_test" fieldSource="cod_test" required="False" caption="Cod Test" wizardCaption="Cod Test" wizardTheme="Inline" wizardThemeType="File" wizardSize="30" wizardMaxLength="30" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="37" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="nom_test" fieldSource="nom_test" required="False" caption="Nom Test" wizardCaption="Nom Test" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<TextBox id="38" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="orden_ingreso" fieldSource="orden_ingreso" required="True" caption="Orden Ingreso" wizardCaption="Orden Ingreso" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" visible="Yes" PathID="compuesto_detalle_testorden_ingreso">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Label id="44" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="False" name="orden_informe" wizardTheme="Inline" wizardThemeType="File" fieldSource="orden_informe">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Button id="39" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Submit" operation="Submit" wizardCaption="Grabar" wizardTheme="Inline" wizardThemeType="File" PathID="compuesto_detalle_testButton_Submit">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="40" urlType="Relative" enableValidation="True" isDefault="False" name="Cancelar" wizardTheme="Inline" wizardThemeType="File" PathID="compuesto_detalle_testCancelar">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="41" conditionType="Parameter" useIsNull="False" field="compuesto_detalle.comp_test_id" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" defaultValue="0" parameterSource="comp_test_id" orderNumber="1"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables>
				<JoinTable id="45" tableName="compuesto_detalle" posWidth="161" posHeight="126" posLeft="10" posTop="10"/>
				<JoinTable id="50" tableName="test" posWidth="153" posHeight="286" posLeft="259" posTop="5"/>
			</JoinTables>
			<JoinLinks>
				<JoinTable2 id="56" fieldLeft="compuesto_detalle.test_id" fieldRight="test.test_id" tableLeft="compuesto_detalle" tableRight="test" conditionType="Equal" joinType="inner"/>
			</JoinLinks>
			<Fields>
				<Field id="46" tableName="compuesto_detalle" fieldName="compuesto_detalle_id"/>
				<Field id="48" tableName="compuesto_detalle" fieldName="comp_test_id"/>
				<Field id="49" tableName="compuesto_detalle" alias="compuesto_detalle_test_id" fieldName="compuesto_detalle.test_id"/>
				<Field id="52" tableName="test" fieldName="cod_test"/>
				<Field id="53" tableName="test" fieldName="nom_test"/>
				<Field id="54" tableName="test" fieldName="orden_informe"/>
				<Field id="55" tableName="test" fieldName="orden_ingreso"/>
			</Fields>
			<PKFields/>
			<ISPParameters/>
			<ISQLParameters/>
			<IFormElements/>
			<USPParameters/>
			<USQLParameters/>
			<UConditions>
				<TableParameter id="42" conditionType="Parameter" useIsNull="False" field="test_id" dataType="Integer" parameterType="DataSourceColumn" parameterSource="compuesto_detalle_test_id" defaultValue="0" searchConditionType="Equal" logicOperator="And" orderNumber="1"/>
			</UConditions>
			<UFormElements>
				<CustomParameter id="43" field="orden_ingreso" dataType="Integer" parameterType="Control" parameterSource="orden_ingreso"/>
			</UFormElements>
			<DSPParameters/>
			<DSQLParameters/>
			<DConditions/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</EditableGrid>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="orden_ingreso_events.php" comment="//" codePage="utf-8" forShow="False"/>
		<CodeFile id="Code" language="PHPTemplates" name="orden_ingreso.php" comment="//" codePage="utf-8" forShow="True" url="orden_ingreso.php"/>
	</CodeFiles>
	<SecurityGroups>
		<Group id="60" groupID="15"/>
		<Group id="61" groupID="16"/>
		<Group id="62" groupID="17"/>
		<Group id="63" groupID="18"/>
		<Group id="64" groupID="19"/>
		<Group id="65" groupID="20"/>
	</SecurityGroups>
	<Events>
		<Event name="BeforeOutput" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="66"/>
			</Actions>
		</Event>
	</Events>
	<CachingParameters/>
	<Attributes/>
	<Features/>
</Page>

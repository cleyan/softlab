<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" wizardTheme="InLine" wizardThemeType="File" needGeneration="0" accessDeniedPage="error_nivel.ccp" cachingEnabled="False" cachingDuration="1 minutes" isService="False">
	<Components>
		<EditableGrid id="2" urlType="Relative" secured="False" emptyRows="0" allowInsert="False" allowUpdate="True" allowDelete="False" validateData="True" preserveParameters="GET" sourceType="Table" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="Datos" dataSource="grupos_detalle, test" name="grupos_detalle_test_grupo" wizardCaption="Lista de Grupos Detalle, Test, Grupos " wizardTheme="Inline" wizardThemeType="File" wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAltRecord="False" wizardRecordSeparator="False" activeCollection="UConditions" activeTableType="customUpdate" returnPage="def_detalle_grupos.ccp" customUpdateType="Table" customUpdate="test" PathID="grupos_detalle_test_grupo">
			<Components>
				<Label id="89" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nom_grupo" wizardTheme="Inline" wizardThemeType="File">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="DLookup" actionCategory="Database" id="90" typeOfTarget="Control" expression="'nom_grupo'" domain="'grupos'" criteria="'grupo_id=' . CCGetParam('grupo_id','0')" connection="Datos" dataType="Text" target="nom_grupo"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="59" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="grupos_detalle_test_grupo_TotalRecords" wizardTheme="Inline" wizardThemeType="File" wizardUseTemplateBlock="False">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Retrieve number of records" actionCategory="Database" id="60"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Sorter id="62" visible="True" name="Sorter_cod_test" column="cod_test" wizardCaption="Cod Test" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="cod_test" PathID="grupos_detalle_test_grupoSorter_cod_test">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="63" visible="True" name="Sorter_nom_test" column="nom_test" wizardCaption="Nom Test" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="nom_test" PathID="grupos_detalle_test_grupoSorter_nom_test">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="64" visible="True" name="Sorter_orden_informe" column="orden_informe" wizardCaption="Orden Informe" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="orden_informe" PathID="grupos_detalle_test_grupoSorter_orden_informe">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Label id="67" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="cod_test" fieldSource="cod_test" required="False" caption="Cod Test" wizardCaption="Cod Test" wizardTheme="Inline" wizardThemeType="File" wizardSize="30" wizardMaxLength="30" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="68" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="nom_test" fieldSource="nom_test" required="False" caption="Nom Test" wizardCaption="Nom Test" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<TextBox id="69" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="orden_informe" fieldSource="orden_informe" required="False" caption="Orden Informe" wizardCaption="Orden Informe" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" visible="Yes" PathID="grupos_detalle_test_grupoorden_informe">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="91" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="orden_ingreso" wizardTheme="Inline" wizardThemeType="File" fieldSource="orden_ingreso" PathID="grupos_detalle_test_grupoorden_ingreso">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Button id="71" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Submit" operation="Submit" wizardCaption="Grabar" wizardTheme="Inline" wizardThemeType="File" PathID="grupos_detalle_test_grupoButton_Submit">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="84" urlType="Relative" enableValidation="True" isDefault="False" name="Cancelar" wizardTheme="Inline" wizardThemeType="File" operation="Cancel" returnPage="def_detalle_grupos.ccp" PathID="grupos_detalle_test_grupoCancelar">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="83" conditionType="Parameter" useIsNull="False" field="grupos_detalle.grupo_id" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" defaultValue="0" parameterSource="grupo_id" orderNumber="1"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables>
				<JoinTable id="72" tableName="grupos_detalle" posWidth="155" posHeight="182" posLeft="169" posTop="12"/>
				<JoinTable id="75" tableName="test" posWidth="168" posHeight="300" posLeft="370" posTop="-2"/>
			</JoinTables>
			<JoinLinks>
				<JoinTable2 id="82" fieldLeft="grupos_detalle.test_id" fieldRight="test.test_id" tableLeft="grupos_detalle" tableRight="test" conditionType="Equal" joinType="inner"/>
			</JoinLinks>
			<Fields>
				<Field id="74" tableName="grupos_detalle" alias="grupos_detalle_test_id" fieldName="grupos_detalle.test_id"/>
				<Field id="76" tableName="test" alias="test_test_id" fieldName="test.test_id"/>
				<Field id="78" tableName="test" fieldName="cod_test"/>
				<Field id="79" tableName="test" fieldName="nom_test"/>
				<Field id="80" tableName="test" fieldName="orden_informe"/>
				<Field id="81" tableName="test" fieldName="orden_ingreso"/>
			</Fields>
			<PKFields/>
			<ISPParameters/>
			<ISQLParameters/>
			<IFormElements/>
			<USPParameters/>
			<USQLParameters/>
			<UConditions>
				<TableParameter id="88" conditionType="Parameter" useIsNull="False" field="test_id" dataType="Integer" searchConditionType="Equal" parameterType="DataSourceColumn" logicOperator="And" parameterSource="test_test_id"/>
			</UConditions>
			<UFormElements>
				<CustomParameter id="86" field="orden_informe" dataType="Integer" parameterType="Control" parameterSource="orden_informe" defaultValue="0"/>
				<CustomParameter id="87" field="orden_ingreso" dataType="Integer" parameterType="Control" parameterSource="orden_ingreso" defaultValue="0"/>
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
		<CodeFile id="Events" language="PHPTemplates" name="edit_orden_events.php" comment="//" codePage="utf-8" forShow="False"/>
		<CodeFile id="Code" language="PHPTemplates" name="edit_orden.php" comment="//" codePage="utf-8" forShow="True" url="edit_orden.php"/>
	</CodeFiles>
	<SecurityGroups>
		<Group id="92" groupID="14"/>
		<Group id="93" groupID="15"/>
		<Group id="94" groupID="16"/>
		<Group id="95" groupID="17"/>
		<Group id="96" groupID="18"/>
		<Group id="97" groupID="19"/>
		<Group id="98" groupID="20"/>
	</SecurityGroups>
	<Events>
		<Event name="BeforeOutput" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="99"/>
			</Actions>
		</Event>
	</Events>
	<CachingParameters/>
	<Attributes/>
	<Features/>
</Page>

<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" needGeneration="0" wizardTheme="InLine" wizardThemeType="File" cachingEnabled="False" cachingDuration="1 minutes" isService="False">
	<Components>
		<Record id="11" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="None" debugMode="False" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="Datos" name="compuesto_detalle" dataSource="compuesto_detalle" errorSummator="Error" wizardCaption="Agregar/Editar Compuesto Detalle " wizardTheme="Inline" wizardThemeType="File" wizardFormMethod="post" activeCollection="TableParameters" activeTableType="dataSource" returnPage="add_compuesto_detalle.ccp" PathID="compuesto_detalle">
			<Components>
				<Hidden id="18" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="comp_test_id" required="False" caption="Comp Test Id" wizardCaption="Comp Test Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="compuesto_detallecomp_test_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="42" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="LinkedID" wizardTheme="Inline" wizardThemeType="File" PathID="compuesto_detalleLinkedID">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="84" fieldSourceType="DBColumn" dataType="Text" html="True" editable="False" name="lbl_grabado" wizardTheme="Inline" wizardThemeType="File">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="85"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<TextBox id="67" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="cadena" wizardTheme="Inline" wizardThemeType="File" visible="Yes" PathID="compuesto_detallecadena">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="22" fieldSourceType="DBColumn" sourceType="Table" dataType="Integer" editable="True" hasErrorCollection="True" returnValueType="Number" name="list_compuestos" wizardTheme="Inline" wizardThemeType="File" wizardEmptyCaption="Seleccionar Valor" connection="Datos" dataSource="compuesto_detalle, test" activeCollection="TableParameters" activeTableType="dataSource" orderBy="cod_test" boundColumn="test_id" textColumn="cod_test" visible="Yes" PathID="compuesto_detallelist_compuestos">
					<Components/>
					<Events/>
					<TableParameters>
						<TableParameter id="34" conditionType="Parameter" useIsNull="False" field="compuesto_detalle.comp_test_id" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="comp_test_id" orderNumber="1" defaultValue="-1"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="70" tableName="compuesto_detalle" posWidth="160" posHeight="138" posLeft="269" posTop="19"/>
						<JoinTable id="72" tableName="test" posWidth="156" posHeight="336" posLeft="34" posTop="18"/>
					</JoinTables>
					<JoinLinks>
						<JoinTable2 id="75" fieldLeft="test.test_id" fieldRight="compuesto_detalle.test_id" tableLeft="test" tableRight="compuesto_detalle" conditionType="Equal" joinType="right"/>
					</JoinLinks>
					<Fields>
						<Field id="71" tableName="compuesto_detalle" fieldName="compuesto_detalle.*"/>
						<Field id="73" tableName="test" fieldName="cod_test"/>
						<Field id="74" tableName="test" fieldName="nom_test"/>
					</Fields>
					<Attributes/>
					<Features/>
					<PKFields/>
				</ListBox>
				<ListBox id="21" fieldSourceType="DBColumn" sourceType="Table" dataType="Integer" editable="True" hasErrorCollection="True" returnValueType="Number" name="list_test" wizardTheme="Inline" wizardThemeType="File" wizardEmptyCaption="Seleccionar Valor" connection="Datos" dataSource="test" boundColumn="test_id" textColumn="cod_test" activeCollection="TableParameters" activeTableType="dataSource" orderBy="cod_test" visible="Yes" PathID="compuesto_detallelist_test">
					<Components/>
					<Events>
						<Event name="BeforeBuildSelect" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="37"/>
							</Actions>
						</Event>
					</Events>
					<TableParameters>
						<TableParameter id="68" conditionType="Parameter" useIsNull="False" field="compuesto" dataType="Text" searchConditionType="NotEqual" parameterType="Expression" logicOperator="And" defaultValue="'V'" parameterSource="'V'" orderNumber="1"/>
						<TableParameter id="69" conditionType="Parameter" useIsNull="False" field="test_id" dataType="Integer" searchConditionType="NotEqual" parameterType="URL" logicOperator="And" parameterSource="comp_test_id" orderNumber="2"/>
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
				<Button id="19" urlType="Relative" enableValidation="False" isDefault="False" name="bt_derecho" wizardTheme="Inline" wizardThemeType="File" PathID="compuesto_detallebt_derecho">
					<Components/>
					<Events>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="35"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="20" urlType="Relative" enableValidation="False" isDefault="False" name="bt_izquierdo" wizardTheme="Inline" wizardThemeType="File" PathID="compuesto_detallebt_izquierdo">
					<Components/>
					<Events>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="36"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="12" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Agregar" PathID="compuesto_detalleButton_Insert">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="13" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Grabar" PathID="compuesto_detalleButton_Update">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<ImageLink id="81" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" editable="False" name="ImageLink1" wizardTheme="Inline" wizardThemeType="File" hrefSource="orden_ingreso.ccp" visible="Yes" PathID="compuesto_detalleImageLink1">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="82" sourceType="DataField" name="comp_test_id" source="comp_test_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</ImageLink>
			</Components>
			<Events>
				<Event name="BeforeDelete" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="40"/>
					</Actions>
				</Event>
				<Event name="OnSubmit" type="Client">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="41"/>
					</Actions>
				</Event>
				<Event name="BeforeInsert" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="64"/>
					</Actions>
				</Event>
				<Event name="BeforeUpdate" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="39"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="17" conditionType="Parameter" useIsNull="False" field="comp_test_id" parameterSource="comp_test_id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1"/>
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
		<CodeFile id="Code" language="PHPTemplates" name="add_compuesto_detalle.php" comment="//" codePage="utf-8" forShow="True" url="add_compuesto_detalle.php"/>
		<CodeFile id="Events" language="PHPTemplates" forShow="False" name="add_compuesto_detalle_events.php" codePage="utf-8" comment="//"/>
	</CodeFiles>
	<SecurityGroups>
		<Group id="86" groupID="14"/>
		<Group id="87" groupID="15"/>
		<Group id="88" groupID="16"/>
		<Group id="89" groupID="17"/>
		<Group id="90" groupID="18"/>
		<Group id="91" groupID="19"/>
		<Group id="92" groupID="20"/>
	</SecurityGroups>
	<Events>
		<Event name="AfterInitialize" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="83"/>
			</Actions>
		</Event>
		<Event name="BeforeOutput" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="93"/>
			</Actions>
		</Event>
	</Events>
	<CachingParameters/>
	<Attributes/>
	<Features/>
</Page>

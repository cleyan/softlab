<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" wizardTheme="InLine" wizardThemeType="File" needGeneration="0" cachingEnabled="False" cachingDuration="1 minutes" isService="False">
	<Components>
		<EditableGrid id="2" urlType="Relative" secured="False" emptyRows="1" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" sourceType="Table" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="grupos_detalle" connection="Datos" dataSource="grupos_detalle, test" wizardCaption="Lista de Grupos Detalle " wizardTheme="Inline" wizardThemeType="File" wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAltRecord="False" wizardRecordSeparator="False" deleteControl="CheckBox_Delete" activeCollection="UConditions" orderBy="orden_informe, nom_test" customInsertType="Table" customInsert="grupos_detalle" customUpdateType="Table" customUpdate="grupos_detalle" customDeleteType="Table" customDelete="grupos_detalle" activeTableType="customUpdate" removeParameters="accion" wizardAllowSorting="True" PathID="grupos_detalle">
			<Components>
				<Label id="107" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nom_grupo" wizardTheme="Inline" wizardThemeType="File">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="DLookup" actionCategory="Database" id="108" typeOfTarget="Control" expression="'nom_grupo'" domain="'grupos'" criteria="&quot;grupo_id=&quot; . CCGetParam(&quot;grupo_id&quot;,&quot;0&quot;)" connection="Datos" dataType="Text" target="nom_grupo"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="4" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="grupos_detalle_TotalRecords" wizardTheme="Inline" wizardThemeType="File" wizardUseTemplateBlock="False">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Retrieve number of records" actionCategory="Database" id="5"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<ImageLink id="66" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" editable="False" name="renum_informe" wizardTheme="Inline" wizardThemeType="File" hrefSource="def_detalle_grupos.ccp" removeParameters="test_id;grupo_id;accion" visible="Yes" PathID="grupos_detallerenum_informe">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="67" sourceType="URL" name="grupo_id" source="grupo_id"/>
						<LinkParameter id="68" sourceType="URL" name="informe_id" source="informe_id"/>
						<LinkParameter id="69" sourceType="Expression" name="accion" source="&quot;renumerar_inf&quot;"/>
						<LinkParameter id="99" sourceType="Expression" name="grupos_detalleOrder" source="&quot;Orden_en_Informe&quot;"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</ImageLink>
				<ImageLink id="101" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" editable="False" name="ImageLink1" wizardTheme="Inline" wizardThemeType="File" hrefSource="edit_orden.ccp" visible="Yes" PathID="grupos_detalleImageLink1">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="103" sourceType="URL" name="grupo_id" source="grupo_id"/>
						<LinkParameter id="105" sourceType="Expression" name="grupos_detalle_test_grupoOrder" source="&quot;Sorter_orden_informe&quot;"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</ImageLink>
				<ListBox id="8" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="test_id" fieldSource="test_id" required="False" caption="Test Id" wizardCaption="Test Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" sourceType="SQL" connection="Datos" dataSource="SELECT
  informes_detalle.informe_id,
  test.cod_test,
  test.nom_test,
  test.orden_informe,
  informes_detalle.test_id
FROM
  informes_detalle
  INNER JOIN test ON (informes_detalle.test_id = test.test_id)
WHERE
  (informes_detalle.informe_id = {informe_id}) AND
  (test.compuesto = 'F')  
  UNION
  
  SELECT
  informes_detalle.informe_id,
  test.cod_test,
  test.nom_test,
  test.orden_informe,
  test.test_id
FROM
  informes_detalle
  INNER JOIN compuesto_detalle ON (informes_detalle.test_id = compuesto_detalle.comp_test_id)
  INNER JOIN test ON (compuesto_detalle.test_id = test.test_id)
WHERE
  (informes_detalle.informe_id = {informe_id})
order by cod_test" activeCollection="SQLParameters" activeTableType="dataSource" orderBy="orden_informe" boundColumn="test_id" textColumn="cod_test" parameterTypeListName="ParameterTypeList" visible="Yes" PathID="grupos_detalletest_id">
					<Components/>
					<Events/>
					<TableParameters>
						<TableParameter id="19" conditionType="Parameter" useIsNull="False" field="informes_detalle.informe_id" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" defaultValue="0" parameterSource="informe_id" orderNumber="1"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters>
						<SQLParameter id="40" variable="informe_id" parameterType="URL" dataType="Integer" parameterSource="informe_id" defaultValue="0"/>
					</SQLParameters>
					<JoinTables>
						<JoinTable id="33" tableName="informes_detalle" posWidth="120" posHeight="266" posLeft="31" posTop="10"/>
						<JoinTable id="35" tableName="test" posWidth="150" posHeight="283" posLeft="286" posTop="16"/>
					</JoinTables>
					<JoinLinks>
						<JoinTable2 id="39" fieldLeft="informes_detalle.test_id" fieldRight="test.test_id" tableLeft="informes_detalle" tableRight="test" conditionType="Equal" joinType="left"/>
					</JoinLinks>
					<Fields>
						<Field id="34" tableName="informes_detalle" fieldName="informes_detalle.*"/>
						<Field id="36" tableName="test" fieldName="cod_test"/>
						<Field id="37" tableName="test" fieldName="nom_test"/>
						<Field id="38" tableName="test" fieldName="orden_informe"/>
					</Fields>
					<Attributes/>
					<Features/>
					<PKFields/>
				</ListBox>
				<Label id="49" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nom_test" wizardTheme="Inline" wizardThemeType="File" fieldSource="nom_test">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Link id="55" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" editable="False" name="imgsube" wizardTheme="Inline" wizardThemeType="File" hrefSource="def_detalle_grupos.ccp" removeParameters="test_id;grupo_id;accion" html="True" visible="Yes" PathID="grupos_detalleimgsube">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="57" sourceType="URL" name="grupo_id" source="grupo_id"/>
						<LinkParameter id="58" sourceType="DataField" name="test_id" source="test_id"/>
						<LinkParameter id="60" sourceType="URL" name="informe_id" source="informe_id"/>
						<LinkParameter id="96" sourceType="Expression" name="accion" source="&quot;sube_inf&quot;"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="50" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="orden_informe" wizardTheme="Inline" wizardThemeType="File" fieldSource="orden_informe">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Link id="56" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" editable="False" name="img_baja" wizardTheme="Inline" wizardThemeType="File" hrefSource="def_detalle_grupos.ccp" removeParameters="test_id;grupo_id;accion" html="True" visible="Yes" PathID="grupos_detalleimg_baja">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="62" sourceType="URL" name="grupo_id" source="grupo_id"/>
						<LinkParameter id="63" sourceType="DataField" name="test_id" source="test_id"/>
						<LinkParameter id="64" sourceType="URL" name="informe_id" source="informe_id"/>
						<LinkParameter id="65" sourceType="Expression" name="accion" source="&quot;baja_inf&quot;"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<CheckBox id="10" fieldSourceType="CodeExpression" dataType="Boolean" editable="True" name="CheckBox_Delete" checkedValue="true" uncheckedValue="false" wizardCaption="Borrar" wizardTheme="Inline" wizardThemeType="File" wizardUseTemplateBlock="True" visible="Yes" PathID="grupos_detalleCheckBox_Delete" defaultValue="Unchecked">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</CheckBox>
				<Button id="12" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Submit" operation="Submit" wizardCaption="Grabar" wizardTheme="Inline" wizardThemeType="File" removeParameters="accion" PathID="grupos_detalleButton_Submit">
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
				<Button id="14" urlType="Relative" enableValidation="False" isDefault="False" name="Cancel" operation="Cancel" wizardCaption="Cancelar" wizardTheme="Inline" wizardThemeType="File" returnPage="def_grupos.ccp" removeParameters="accion" PathID="grupos_detalleCancel">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
			</Components>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Declare Variable" actionCategory="General" id="70" name="r" type="Integer" initialValue="1"/>
					</Actions>
				</Event>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="71"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="15" conditionType="Parameter" useIsNull="False" field="grupo_id" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="grupo_id" orderNumber="1" defaultValue="0"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables>
				<JoinTable id="73" tableName="grupos_detalle" posWidth="104" posHeight="186" posLeft="10" posTop="10"/>
				<JoinTable id="76" tableName="test" posWidth="270" posHeight="532" posLeft="179" posTop="20"/>
			</JoinTables>
			<JoinLinks>
				<JoinTable2 id="81" fieldLeft="grupos_detalle.test_id" fieldRight="test.test_id" tableLeft="grupos_detalle" tableRight="test" conditionType="Equal" joinType="left"/>
			</JoinLinks>
			<Fields>
				<Field id="74" tableName="grupos_detalle" fieldName="grupos_detalle.*"/>
				<Field id="78" tableName="test" fieldName="nom_test"/>
				<Field id="79" tableName="test" fieldName="orden_informe"/>
				<Field id="80" tableName="test" fieldName="orden_ingreso"/>
			</Fields>
			<PKFields>
			</PKFields>
			<ISPParameters/>
			<ISQLParameters/>
			<IFormElements>
				<CustomParameter id="16" field="test_id" dataType="Integer" parameterType="Control" parameterSource="test_id"/>
				<CustomParameter id="18" field="grupo_id" dataType="Integer" parameterType="URL" parameterSource="grupo_id"/>
			</IFormElements>
			<USPParameters/>
			<USQLParameters/>
			<UConditions>
				<TableParameter id="51" conditionType="Parameter" useIsNull="False" field="grupo_detalle_id" dataType="Integer" parameterType="DataSourceColumn" parameterSource="grupo_detalle_id" defaultValue="0" searchConditionType="Equal" logicOperator="And" orderNumber="1"/>
			</UConditions>
			<UFormElements>
				<CustomParameter id="52" field="test_id" dataType="Integer" parameterType="Control" parameterSource="test_id"/>
			</UFormElements>
			<DSPParameters/>
			<DSQLParameters/>
			<DConditions>
				<TableParameter id="53" conditionType="Parameter" useIsNull="False" field="grupo_detalle_id" dataType="Integer" parameterType="DataSourceColumn" parameterSource="grupo_detalle_id" defaultValue="0" searchConditionType="Equal" logicOperator="And" orderNumber="1"/>
				<TableParameter id="54" conditionType="Parameter" useIsNull="False" field="grupo_id" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" defaultValue="0" parameterSource="grupo_id"/>
			</DConditions>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</EditableGrid>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="def_detalle_grupos_events.php" comment="//" codePage="utf-8" forShow="False"/>
		<CodeFile id="Code" language="PHPTemplates" name="def_detalle_grupos.php" comment="//" codePage="utf-8" forShow="True" url="def_detalle_grupos.php"/>
	</CodeFiles>
	<SecurityGroups/>
	<Events>
		<Event name="AfterInitialize" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="61"/>
			</Actions>
		</Event>
		<Event name="BeforeOutput" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="109"/>
			</Actions>
		</Event>
	</Events>
	<CachingParameters/>
	<Attributes/>
	<Features/>
</Page>

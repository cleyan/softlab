<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" wizardTheme="InLine" wizardThemeType="File" needGeneration="0" cachingEnabled="False" cachingDuration="1 minutes" isService="False">
	<Components>
		<Record id="11" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" debugMode="False" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="peticiones_previsiones_prSearch" wizardCaption="Buscar Peticiones, Previsiones, Procedencias " wizardTheme="Inline" wizardThemeType="File" wizardOrientation="Vertical" wizardFormMethod="post" returnPage="stat_numerotest.ccp" PathID="peticiones_previsiones_prSearch">
			<Components>
				<ListBox id="13" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="s_procedencia_id" wizardCaption="Procedencia Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" sourceType="Table" connection="Datos" dataSource="procedencias" boundColumn="procedencia_id" textColumn="nom_procedencia" defaultValue="GetUserProcedenciaID()" activeCollection="TableParameters" activeTableType="dataSource" orderBy="nom_procedencia" visible="Yes" PathID="peticiones_previsiones_prSearchs_procedencia_id">
					<Components/>
					<Events/>
					<TableParameters>
						<TableParameter id="125" conditionType="Parameter" useIsNull="False" field="procedencia_id" dataType="Integer" searchConditionType="Equal" parameterType="Expression" logicOperator="Or" parameterSource="GetUserProcedenciaID()" orderNumber="1"/>
						<TableParameter id="126" conditionType="Expression" useIsNull="False" searchConditionType="Equal" parameterType="URL" logicOperator="And" expression="&quot; . CCGetGroupID() . &quot; &gt; 4" orderNumber="2"/>
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
				<ListBox id="91" fieldSourceType="DBColumn" sourceType="Table" dataType="Integer" editable="True" hasErrorCollection="True" returnValueType="Number" name="s_equipo_id" wizardTheme="Inline" wizardThemeType="File" wizardEmptyCaption="Seleccionar Valor" connection="Datos" dataSource="equipos" boundColumn="equipo_id" textColumn="nom_equipo" visible="Yes" PathID="peticiones_previsiones_prSearchs_equipo_id">
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
				<TextBox id="15" fieldSourceType="DBColumn" dataType="Date" html="False" editable="True" hasErrorCollection="True" name="s_fecha_ini" wizardCaption="Fecha" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" format="dd/mm/yyyy" DBFormat="yyyy-mm-dd HH:nn:ss" required="True" caption="Fecha Inicial" visible="Yes" PathID="peticiones_previsiones_prSearchs_fecha_ini">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="67" fieldSourceType="DBColumn" dataType="Date" html="False" editable="True" hasErrorCollection="True" name="s_fecha_fin" wizardTheme="Inline" wizardThemeType="File" format="dd/mm/yyyy" DBFormat="yyyy-mm-dd HH:nn:ss" required="True" caption="Fecha Final" visible="Yes" PathID="peticiones_previsiones_prSearchs_fecha_fin">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="71" fieldSourceType="DBColumn" sourceType="ListOfValues" dataType="Text" html="True" editable="True" returnValueType="Number" name="s_decompuesto" wizardTheme="Inline" wizardThemeType="File" required="True" _valueOfList="F" _nameOfList="Sólo Los pedidos Aislados" dataSource="V;Sólo los pedidos en un Compuesto;F;Sólo Los pedidos Aislados" caption="Tipo de Informe" hasErrorCollection="True" visible="Yes" PathID="peticiones_previsiones_prSearchs_decompuesto">
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
				<Button id="12" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Buscar" PathID="peticiones_previsiones_prSearchButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
			</Components>
			<Events/>
			<TableParameters/>
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
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" connection="Datos" dataSource="SELECT 
  test.codigo_fonasa,
  test.cod_test,
  test.nom_test,
  COUNT(*) AS qty
FROM
peticiones
RIGHT OUTER JOIN peticiones_detalle ON ( peticiones.peticion_id = peticiones_detalle.peticion_id )
LEFT OUTER JOIN test ON ( peticiones_detalle.test_id = test.test_id ) 
WHERE
  (test.aislado = 'V') AND 
  (peticiones.fecha BETWEEN '{s_fecha_ini}' AND '{s_fecha_fin}') AND 
  (peticiones_detalle.decompuesto = '{s_decompuesto}' or 'X' = '{s_decompuesto}') AND 
  (peticiones.procedencia_id = {s_procedencia_id} or '0'='{s_procedencia_id}') AND 
  (test.equipo_id={s_equipo_id} or '0' = '{s_equipo_id}')
GROUP BY
  test.codigo_fonasa,
  test.cod_test,
  test.nom_test
ORDER BY
  test.cod_test" name="peticiones_previsiones_pr" wizardCaption="Lista de Peticiones, Previsiones, Procedencias " wizardTheme="Inline" wizardThemeType="File" wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAllowInsert="False" wizardAltRecord="False" wizardRecordSeparator="False" orderBy="peticion_id" wizardAllowSorting="True" wizardUsePageScroller="True" activeCollection="SQLParameters" activeTableType="dataSource" parameterTypeListName="ParameterTypeList" PathID="peticiones_previsiones_pr">
			<Components>
				<Label id="110" fieldSourceType="DBColumn" dataType="Date" html="False" editable="False" name="s_fecha_ini" wizardTheme="Inline" wizardThemeType="File" format="dd/mm/yyyy" DBFormat="yyyy-mm-dd HH:nn:ss">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="111" fieldSourceType="DBColumn" dataType="Date" html="False" editable="False" name="s_fecha_fin" wizardTheme="Inline" wizardThemeType="File" format="dd/mm/yyyy" DBFormat="yyyy-mm-dd HH:nn:ss">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="109" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="codigo_fonasa" wizardTheme="Inline" wizardThemeType="File" fieldSource="codigo_fonasa">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="101" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="cod_test" wizardTheme="Inline" wizardThemeType="File" fieldSource="cod_test">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="102" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nom_test" wizardTheme="Inline" wizardThemeType="File" fieldSource="nom_test">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="103" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="False" name="qty" wizardTheme="Inline" wizardThemeType="File" fieldSource="qty">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events>
				<Event name="BeforeSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="140"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="21" conditionType="Parameter" useIsNull="False" field="peticiones.fecha" parameterSource="s_fecha_ini" dataType="Date" logicOperator="And" searchConditionType="GreaterThanOrEqual" parameterType="URL" orderNumber="3" leftBrackets="1"/>
				<TableParameter id="68" conditionType="Parameter" useIsNull="False" field="peticiones.fecha" dataType="Date" searchConditionType="LessThanOrEqual" parameterType="URL" logicOperator="And" parameterSource="s_fecha_fin" orderNumber="4" rightBrackets="1"/>
				<TableParameter id="90" conditionType="Parameter" useIsNull="False" field="peticiones.procedencia_id" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="s_procedencia_id" orderNumber="5"/>
				<TableParameter id="92" conditionType="Parameter" useIsNull="False" field="test.equipo_id" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="s_equipo_id" orderNumber="6"/>
				<TableParameter id="93" conditionType="Parameter" useIsNull="False" field="test.aislado" dataType="Text" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="'V'" orderNumber="7"/>
				<TableParameter id="99" conditionType="Parameter" useIsNull="False" field="peticiones_detalle.decompuesto" dataType="Text" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="s_decompuesto" orderNumber="8"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="73" tableName="peticiones" posWidth="132" posHeight="276" posLeft="286" posTop="0"/>
				<JoinTable id="75" tableName="previsiones" posWidth="100" posHeight="100" posLeft="430" posTop="126"/>
				<JoinTable id="77" tableName="procedencias" posWidth="100" posHeight="100" posLeft="436" posTop="3"/>
				<JoinTable id="79" tableName="peticiones_detalle" posWidth="111" posHeight="274" posLeft="152" posTop="7"/>
				<JoinTable id="81" tableName="test" posWidth="119" posHeight="291" posLeft="10" posTop="10"/>
			</JoinTables>
			<JoinLinks>
				<JoinTable2 id="86" tableLeft="peticiones" fieldLeft="peticiones.prevision_id" tableRight="previsiones" fieldRight="previsiones.prevision_id" joinType="left" conditionType="Equal"/>
				<JoinTable2 id="87" tableLeft="peticiones" fieldLeft="peticiones.procedencia_id" tableRight="procedencias" fieldRight="procedencias.procedencia_id" joinType="left" conditionType="Equal"/>
				<JoinTable2 id="88" tableLeft="peticiones_detalle" fieldLeft="peticiones_detalle.peticion_id" tableRight="peticiones" fieldRight="peticiones.peticion_id" joinType="right" conditionType="Equal"/>
				<JoinTable2 id="89" tableLeft="peticiones_detalle" fieldLeft="peticiones_detalle.test_id" tableRight="test" fieldRight="test.test_id" joinType="left" conditionType="Equal"/>
			</JoinLinks>
			<Fields>
				<Field id="74" tableName="peticiones" fieldName="peticiones.*"/>
				<Field id="76" tableName="previsiones" fieldName="nom_prevision"/>
				<Field id="78" tableName="procedencias" fieldName="nom_procedencia"/>
				<Field id="80" tableName="peticiones_detalle" fieldName="decompuesto"/>
				<Field id="82" tableName="test" fieldName="secciones_id"/>
				<Field id="83" tableName="test" fieldName="equipo_id"/>
				<Field id="84" tableName="test" fieldName="cod_test"/>
				<Field id="85" tableName="test" fieldName="nom_test"/>
			</Fields>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="94" variable="s_fecha_ini" parameterType="URL" dataType="Date" parameterSource="s_fecha_ini" defaultValue="4/17/2005"/>
				<SQLParameter id="95" variable="s_fecha_fin" parameterType="URL" dataType="Date" parameterSource="s_fecha_fin" defaultValue="4/17/2005"/>
				<SQLParameter id="96" variable="s_procedencia_id" parameterType="URL" dataType="Integer" parameterSource="s_procedencia_id" defaultValue="0"/>
				<SQLParameter id="97" variable="s_equipo_id" parameterType="URL" dataType="Integer" parameterSource="s_equipo_id" defaultValue="0"/>
				<SQLParameter id="100" variable="s_decompuesto" parameterType="URL" dataType="Text" parameterSource="s_decompuesto"/>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
			<PKFields/>
		</Grid>
		<Record id="112" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" debugMode="False" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="Impresion" wizardTheme="InLine" wizardThemeType="File" actionPage="stat_numerotest" errorSummator="Error" wizardFormMethod="post" PathID="Impresion">
			<Components>
				<Hidden id="113" fieldSourceType="DBColumn" dataType="Date" html="False" editable="True" hasErrorCollection="True" name="s_fecha_ini" wizardTheme="None" wizardThemeType="File" caption="Fecha Incial" format="dd/mm/yyyy" DBFormat="yyyy-mm-dd HH:nn:ss" required="True" PathID="Impresions_fecha_ini">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="114" fieldSourceType="DBColumn" dataType="Date" html="False" editable="True" hasErrorCollection="True" name="s_fecha_fin" wizardTheme="None" wizardThemeType="File" required="True" caption="Fecha Final" format="dd/mm/yyyy" DBFormat="yyyy-mm-dd HH:nn:ss" PathID="Impresions_fecha_fin">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="121" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="s_procedencia_id" wizardTheme="InLine" wizardThemeType="File" PathID="Impresions_procedencia_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="122" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="s_equipo_id" wizardTheme="InLine" wizardThemeType="File" PathID="Impresions_equipo_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="123" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="s_decompuesto" wizardTheme="InLine" wizardThemeType="File" PathID="Impresions_decompuesto">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Button id="119" urlType="Relative" enableValidation="True" isDefault="False" name="Imprimir" wizardTheme="InLine" wizardThemeType="File" PathID="ImpresionImprimir">
					<Components/>
					<Events>
						<Event name="OnClick" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="120"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="118" urlType="Relative" enableValidation="False" isDefault="False" name="Cancelar" wizardTheme="InLine" wizardThemeType="File" operation="Cancel" returnPage="menu_principal.ccp" PathID="ImpresionCancelar">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
			</Components>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="139"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters/>
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
		<IncludePage id="70" hasOperation="True" name="calendar_tag" wizardTheme="InLine" wizardThemeType="File" page="calendar_tag.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
		<IncludePage id="141" name="Header" page="Header.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="stat_numerotest_events.php" comment="//" codePage="utf-8" forShow="False"/>
		<CodeFile id="Code" language="PHPTemplates" name="stat_numerotest.php" comment="//" codePage="utf-8" forShow="True" url="stat_numerotest.php"/>
	</CodeFiles>
	<SecurityGroups>
		<Group id="127" groupID="4"/>
		<Group id="128" groupID="5"/>
		<Group id="129" groupID="12"/>
		<Group id="130" groupID="13"/>
		<Group id="131" groupID="14"/>
		<Group id="132" groupID="15"/>
		<Group id="133" groupID="16"/>
		<Group id="134" groupID="17"/>
		<Group id="135" groupID="18"/>
		<Group id="136" groupID="19"/>
		<Group id="137" groupID="20"/>
	</SecurityGroups>
	<Events>
		<Event name="BeforeOutput" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="138"/>
			</Actions>
		</Event>
	</Events>
	<CachingParameters/>
	<Attributes/>
	<Features/>
</Page>

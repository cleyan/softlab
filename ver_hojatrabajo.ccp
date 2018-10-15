<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" wizardTheme="InLine" wizardThemeType="File" needGeneration="0" accessDeniedPage="error_nivel.ccp" cachingEnabled="False" cachingDuration="1 minutes" isService="False">
	<Components>
		<Label id="429" fieldSourceType="DBColumn" dataType="Text" html="True" editable="False" name="fun_imprimir" wizardTheme="InLine" wizardThemeType="File">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Label>
		<Record id="27" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" debugMode="False" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="peticiones_detalle_test_sSearch" wizardCaption="Buscar Peticiones Detalle, Test, Secciones, Equipos, Prioridades " wizardTheme="Inline" wizardThemeType="File" wizardOrientation="Vertical" wizardFormMethod="post" returnPage="ver_hojatrabajo.ccp" PathID="peticiones_detalle_test_sSearch">
			<Components>
				<ListBox id="30" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="s_test_equipo_id" wizardCaption="Test Equipo Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" sourceType="Table" connection="Datos" dataSource="equipos" boundColumn="equipo_id" textColumn="nom_equipo" visible="Yes" PathID="peticiones_detalle_test_sSearchs_test_equipo_id">
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
				<ListBox id="31" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="s_secciones_id" wizardCaption="Secciones Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" sourceType="Table" connection="Datos" dataSource="secciones" boundColumn="seccion_id" textColumn="nom_seccion" visible="Yes" PathID="peticiones_detalle_test_sSearchs_secciones_id">
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
				<TextBox id="62" fieldSourceType="DBColumn" dataType="Date" html="False" editable="True" hasErrorCollection="True" name="s_fecha" wizardTheme="Inline" wizardThemeType="File" format="dd/mm/yyyy" DBFormat="yyyy-mm-dd HH:nn:ss" defaultValue="CurrentDate" visible="Yes" PathID="peticiones_detalle_test_sSearchs_fecha">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="266" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" editable="True" hasErrorCollection="True" returnValueType="Number" name="s_estado_id" wizardTheme="Inline" wizardThemeType="File" wizardEmptyCaption="Seleccionar Valor" connection="Datos" dataSource="estados" boundColumn="estado_id" textColumn="nom_estado" activeCollection="TableParameters" activeTableType="dataSource" orderBy="estado_id" visible="Yes" PathID="peticiones_detalle_test_sSearchs_estado_id">
					<Components/>
					<Events/>
					<TableParameters>
						<TableParameter id="267" conditionType="Parameter" useIsNull="True" field="usar_en" dataType="Text" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="'peticiones_detalle'" orderNumber="1"/>
						<TableParameter id="269" conditionType="Parameter" useIsNull="False" field="activo" dataType="Text" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="'V'" orderNumber="2"/>
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
				<Button id="29" urlType="Relative" enableValidation="True" isDefault="True" name="Button_DoSearch" operation="Search" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Buscar" PathID="peticiones_detalle_test_sSearchButton_DoSearch">
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
		<Grid id="2" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="10" connection="Datos" dataSource="peticiones_detalle, test, secciones, equipos, prioridades, peticiones, tipos_muestra, pacientes, estados" name="peticiones_detalle_test_s" pageSizeLimit="100" wizardCaption="Lista de Peticiones Detalle, Test, Secciones, Equipos, Prioridades " wizardTheme="Inline" wizardThemeType="File" wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAllowInsert="False" wizardAltRecord="True" wizardRecordSeparator="False" activeCollection="TableParameters" activeTableType="dataSource" orderBy="peticiones.peticion_id, detalle_peticion_id" wizardUsePageScroller="True" PathID="peticiones_detalle_test_s">
			<Components>
				<Label id="34" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="peticiones_detalle_test_s_TotalRecords" wizardTheme="Inline" wizardThemeType="File" wizardUseTemplateBlock="False">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Retrieve number of records" actionCategory="Database" id="35"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Sorter id="42" visible="True" name="Sorter_muestra_id" column="muestra_id" wizardCaption="Muestra Id" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="muestra_id" PathID="peticiones_detalle_test_sSorter_muestra_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="43" visible="True" name="Sorter_nom_prioridad" column="nom_prioridad" wizardCaption="Nom Prioridad" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="nom_prioridad" PathID="peticiones_detalle_test_sSorter_nom_prioridad">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Label id="262" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nombres" wizardTheme="Inline" wizardThemeType="File" fieldSource="nombres">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="264" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="apellidos" wizardTheme="Inline" wizardThemeType="File" fieldSource="apellidos">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="49" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="muestra_id" fieldSource="muestra_id" wizardCaption="Muestra Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="53" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nom_test" fieldSource="cod_test" wizardCaption="Nom Test" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="225" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nom_tipo_muestra" wizardTheme="Inline" wizardThemeType="File" fieldSource="nom_tipo_muestra">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="270" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nom_estado" wizardTheme="Inline" wizardThemeType="File" fieldSource="nom_estado">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="50" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nom_prioridad" fieldSource="nom_prioridad" wizardCaption="Nom Prioridad" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="263" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="Alt_nombres" wizardTheme="Inline" wizardThemeType="File" fieldSource="nombres">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="265" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="Alt_apellidos" wizardTheme="Inline" wizardThemeType="File" fieldSource="apellidos">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="56" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="Alt_muestra_id" fieldSource="muestra_id" wizardCaption="Muestra Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="60" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="Alt_nom_test" fieldSource="cod_test" wizardCaption="Nom Test" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="226" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="Alt_nom_tipo_muestra" wizardTheme="Inline" wizardThemeType="File" fieldSource="nom_tipo_muestra">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="307" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="Alt_nom_estado" wizardTheme="Inline" wizardThemeType="File" fieldSource="nom_estado">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="57" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="Alt_nom_prioridad" fieldSource="nom_prioridad" wizardCaption="Nom Prioridad" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="441" size="10" type="Simple" name="Navigator1" wizardTheme="Inline" wizardThemeType="File" wizardPagingType="Custom" wizardPageNumbers="Simple" wizardTotalPages="True" wizardImages="Images" wizardHideDisabled="True" wizardFirst="True" wizardPrev="True" wizardNext="True" wizardLast="True" wizardFirstText="Inicio" wizardPrevText="Anterior" wizardNextText="Siguiente" wizardLastText="Final" wizardOfText="de" pageSizes="1;5;10;25;50" PathID="peticiones_detalle_test_sNavigator1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
			</Components>
			<Events>
				<Event name="AfterExecuteSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="428"/>
					</Actions>
				</Event>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="442"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="36" conditionType="Parameter" useIsNull="False" field="test.equipo_id" parameterSource="s_test_equipo_id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1"/>
				<TableParameter id="37" conditionType="Parameter" useIsNull="False" field="test.secciones_id" parameterSource="s_secciones_id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="2"/>
				<TableParameter id="38" conditionType="Parameter" useIsNull="False" field="peticiones_detalle.muestra_id" parameterSource="s_muestra_id" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="3"/>
				<TableParameter id="39" conditionType="Parameter" useIsNull="False" field="test.test_id" parameterSource="s_test_test_id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="4"/>
				<TableParameter id="163" conditionType="Parameter" useIsNull="False" field="peticiones.fecha" dataType="Date" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="s_fecha" orderNumber="5" defaultValue="GetFechaServer()"/>
				<TableParameter id="192" conditionType="Parameter" useIsNull="False" field="test.aislado" dataType="Text" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="'V'" orderNumber="6" defaultValue="'V'"/>
				<TableParameter id="268" conditionType="Parameter" useIsNull="False" field="peticiones_detalle.estado_id" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="s_estado_id" orderNumber="8"/>
				<TableParameter id="426" conditionType="Parameter" useIsNull="False" field="peticiones_detalle.decompuesto" dataType="Text" searchConditionType="NotEqual" parameterType="Expression" logicOperator="And" parameterSource="'V'" orderNumber="9"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="387" tableName="peticiones_detalle" posWidth="145" posHeight="190" posLeft="171" posTop="10"/>
				<JoinTable id="394" tableName="test" posWidth="145" posHeight="355" posLeft="388" posTop="12"/>
				<JoinTable id="400" tableName="secciones" posWidth="100" posHeight="113" posLeft="609" posTop="136"/>
				<JoinTable id="403" tableName="equipos" posWidth="229" posHeight="118" posLeft="635" posTop="7"/>
				<JoinTable id="406" tableName="prioridades" posWidth="100" posHeight="100" posLeft="10" posTop="10"/>
				<JoinTable id="409" tableName="peticiones" posWidth="211" posHeight="303" posLeft="578" posTop="263"/>
				<JoinTable id="411" tableName="tipos_muestra" posWidth="100" posHeight="100" posLeft="839" posTop="162"/>
				<JoinTable id="413" tableName="pacientes" posWidth="100" posHeight="247" posLeft="865" posTop="344"/>
				<JoinTable id="416" tableName="estados" posWidth="100" posHeight="100" posLeft="204" posTop="326"/>
			</JoinTables>
			<JoinLinks>
				<JoinTable2 id="418" fieldLeft="peticiones_detalle.test_id" fieldRight="test.test_id" tableLeft="peticiones_detalle" tableRight="test" conditionType="Equal" joinType="left"/>
				<JoinTable2 id="419" fieldLeft="test.equipo_id" fieldRight="equipos.equipo_id" tableLeft="test" tableRight="equipos" conditionType="Equal" joinType="left"/>
				<JoinTable2 id="420" fieldLeft="test.secciones_id" fieldRight="secciones.seccion_id" tableLeft="test" tableRight="secciones" conditionType="Equal" joinType="left"/>
				<JoinTable2 id="421" fieldLeft="peticiones_detalle.prioridad_id" fieldRight="prioridades.prioridad_id" tableLeft="peticiones_detalle" tableRight="prioridades" conditionType="Equal" joinType="left"/>
				<JoinTable2 id="422" fieldLeft="peticiones_detalle.peticion_id" fieldRight="peticiones.peticion_id" tableLeft="peticiones_detalle" tableRight="peticiones" conditionType="Equal" joinType="left"/>
				<JoinTable2 id="423" fieldLeft="test.tipo_muestra_id" fieldRight="tipos_muestra.tipo_muestra_id" tableLeft="test" tableRight="tipos_muestra" conditionType="Equal" joinType="left"/>
				<JoinTable2 id="424" fieldLeft="peticiones.paciente_id" fieldRight="pacientes.paciente_id" tableLeft="peticiones" tableRight="pacientes" conditionType="Equal" joinType="left"/>
				<JoinTable2 id="425" fieldLeft="peticiones_detalle.estado_id" fieldRight="estados.estado_id" tableLeft="peticiones_detalle" tableRight="estados" conditionType="Equal" joinType="left"/>
			</JoinLinks>
			<Fields>
				<Field id="388" tableName="peticiones_detalle" fieldName="detalle_peticion_id"/>
				<Field id="389" tableName="peticiones_detalle" alias="peticiones_detalle_peticion_id" fieldName="peticiones_detalle.peticion_id"/>
				<Field id="390" tableName="peticiones_detalle" fieldName="muestra_id"/>
				<Field id="391" tableName="peticiones_detalle" alias="peticiones_detalle_test_id" fieldName="peticiones_detalle.test_id"/>
				<Field id="392" tableName="peticiones_detalle" alias="peticiones_detalle_estado_id" fieldName="peticiones_detalle.estado_id"/>
				<Field id="393" tableName="peticiones_detalle" alias="peticiones_detalle_prioridad_id" fieldName="peticiones_detalle.prioridad_id"/>
				<Field id="395" tableName="test" alias="test_test_id" fieldName="test.test_id"/>
				<Field id="396" tableName="test" fieldName="secciones_id"/>
				<Field id="397" tableName="test" alias="test_equipo_id" fieldName="test.equipo_id"/>
				<Field id="398" tableName="test" fieldName="cod_test"/>
				<Field id="399" tableName="test" fieldName="nom_test"/>
				<Field id="401" tableName="secciones" fieldName="seccion_id"/>
				<Field id="402" tableName="secciones" fieldName="nom_seccion"/>
				<Field id="404" tableName="equipos" alias="equipos_equipo_id" fieldName="equipos.equipo_id"/>
				<Field id="405" tableName="equipos" fieldName="nom_equipo"/>
				<Field id="407" tableName="prioridades" alias="prioridades_prioridad_id" fieldName="prioridades.prioridad_id"/>
				<Field id="408" tableName="prioridades" fieldName="nom_prioridad"/>
				<Field id="410" tableName="peticiones" fieldName="fecha"/>
				<Field id="412" tableName="tipos_muestra" fieldName="nom_tipo_muestra"/>
				<Field id="414" tableName="pacientes" fieldName="nombres"/>
				<Field id="415" tableName="pacientes" fieldName="apellidos"/>
				<Field id="417" tableName="estados" fieldName="nom_estado"/>
			</Fields>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
			<PKFields/>
		</Grid>
		<IncludePage id="440" name="calendar_tag1" wizardTheme="InLine" wizardThemeType="File" page="calendar_tag.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="ver_hojatrabajo_events.php" comment="//" codePage="utf-8" forShow="False"/>
		<CodeFile id="Code" language="PHPTemplates" name="ver_hojatrabajo.php" comment="//" codePage="utf-8" forShow="True" url="ver_hojatrabajo.php"/>
	</CodeFiles>
	<SecurityGroups>
		<Group id="443" groupID="4"/>
		<Group id="444" groupID="5"/>
		<Group id="445" groupID="12"/>
		<Group id="446" groupID="13"/>
		<Group id="447" groupID="14"/>
		<Group id="448" groupID="15"/>
		<Group id="449" groupID="16"/>
		<Group id="450" groupID="17"/>
		<Group id="451" groupID="18"/>
		<Group id="452" groupID="19"/>
		<Group id="453" groupID="20"/>
	</SecurityGroups>
	<Events>
		<Event name="BeforeOutput" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="439"/>
			</Actions>
		</Event>
	</Events>
	<CachingParameters/>
	<Attributes/>
	<Features/>
</Page>

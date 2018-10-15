<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" wizardTheme="InLine" wizardThemeType="File" needGeneration="0" accessDeniedPage="error_nivel.ccp" cachingEnabled="False" cachingDuration="1 minutes" isService="False">
	<Components>
		<Record id="11" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" debugMode="False" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="peticiones_previsiones_prSearch" wizardCaption="Buscar Peticiones, Previsiones, Procedencias " wizardTheme="Inline" wizardThemeType="File" wizardOrientation="Vertical" wizardFormMethod="post" returnPage="stat_liquidacion.ccp" PathID="peticiones_previsiones_prSearch">
			<Components>
				<ListBox id="13" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="s_procedencia_id" wizardCaption="Procedencia Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" sourceType="Table" connection="Datos" dataSource="procedencias" boundColumn="procedencia_id" textColumn="nom_procedencia" defaultValue="GetUserProcedenciaID()" activeCollection="TableParameters" activeTableType="dataSource" orderBy="nom_procedencia" visible="Yes" PathID="peticiones_previsiones_prSearchs_procedencia_id">
					<Components/>
					<Events/>
					<TableParameters>
						<TableParameter id="149" conditionType="Parameter" useIsNull="False" field="procedencia_id" dataType="Integer" searchConditionType="Equal" parameterType="Expression" logicOperator="Or" parameterSource="GetUserProcedenciaID()" orderNumber="1"/>
						<TableParameter id="150" conditionType="Expression" useIsNull="False" searchConditionType="Equal" parameterType="URL" logicOperator="And" expression="&quot; . CCGetGroupID() . &quot; &gt; 4" orderNumber="2"/>
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
				<ListBox id="14" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="s_prevision_id" wizardCaption="Prevision Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" sourceType="Table" connection="Datos" dataSource="previsiones" boundColumn="prevision_id" textColumn="nom_prevision" visible="Yes" PathID="peticiones_previsiones_prSearchs_prevision_id">
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
		<Grid id="2" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="10" connection="Datos" dataSource="peticiones, previsiones, procedencias, pacientes" name="peticiones_previsiones_pr" pageSizeLimit="100" wizardCaption="Lista de Peticiones, Previsiones, Procedencias " wizardTheme="Inline" wizardThemeType="File" wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAllowInsert="False" wizardAltRecord="False" wizardRecordSeparator="False" orderBy="peticion_id" wizardAllowSorting="True" wizardUsePageScroller="True" activeCollection="TableParameters" activeTableType="dataSource" PathID="peticiones_previsiones_pr">
			<Components>
				<Label id="17" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="peticiones_previsiones_pr_TotalRecords" wizardTheme="Inline" wizardThemeType="File" wizardUseTemplateBlock="False">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Retrieve number of records" actionCategory="Database" id="18"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Sorter id="23" visible="True" name="Sorter_fecha" column="fecha" wizardCaption="Fecha" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="fecha" PathID="peticiones_previsiones_prSorter_fecha">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="22" visible="True" name="Sorter_peticion_id" column="peticion_id" wizardCaption="Peticion Id" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="peticion_id" PathID="peticiones_previsiones_prSorter_peticion_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="43" visible="True" name="Paciente" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="Simple" column="nombres" PathID="peticiones_previsiones_prPaciente">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="25" visible="True" name="Sorter_nom_procedencia" column="nom_procedencia" wizardCaption="Nom Procedencia" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="nom_procedencia" PathID="peticiones_previsiones_prSorter_nom_procedencia">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="24" visible="True" name="Sorter_nom_prevision" column="nom_prevision" wizardCaption="Nom Prevision" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="nom_prevision" PathID="peticiones_previsiones_prSorter_nom_prevision">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Label id="27" fieldSourceType="DBColumn" dataType="Date" html="False" editable="False" name="fecha" fieldSource="fecha" wizardCaption="Fecha" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" format="dd/mm/yyyy" DBFormat="yyyy-mm-dd HH:nn:ss">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="26" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="False" name="peticion_id" fieldSource="peticion_id" wizardCaption="Peticion Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="53" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="s_peticion_id" wizardTheme="Inline" wizardThemeType="File" fieldSource="peticion_id" PathID="peticiones_previsiones_prs_peticion_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="44" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nombres" wizardTheme="Inline" wizardThemeType="File" fieldSource="nombres">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="45" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="apellidos" wizardTheme="Inline" wizardThemeType="File" fieldSource="apellidos">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="29" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nom_procedencia" fieldSource="nom_procedencia" wizardCaption="Nom Procedencia" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="28" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nom_prevision" fieldSource="nom_prevision" wizardCaption="Nom Prevision" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="51" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="False" name="lbl_total" wizardTheme="Inline" wizardThemeType="File" format="$0">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="52"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="54" type="Simple" name="Navigator1" wizardPagingType="Custom" wizardPageNumbers="Simple" wizardTotalPages="True" wizardImages="True" wizardHideDisabled="True" wizardFirst="True" wizardPrev="True" wizardNext="True" wizardLast="True" wizardFirstText="Inicio" wizardPrevText="Anterior" wizardNextText="Siguiente" wizardLastText="Final" wizardOfText="de" wizardTheme="InLine" wizardThemeType="File" wizardImagesScheme="Square" size="10" pageSizes="1;5;10;25;50" PathID="peticiones_previsiones_prNavigator1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
			</Components>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="154"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="19" conditionType="Parameter" useIsNull="False" field="peticiones.procedencia_id" parameterSource="s_procedencia_id" dataType="Integer" logicOperator="Or" searchConditionType="Equal" parameterType="URL" orderNumber="1" leftBrackets="0"/>
				<TableParameter id="20" conditionType="Parameter" useIsNull="False" field="peticiones.prevision_id" parameterSource="s_prevision_id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="2"/>
				<TableParameter id="21" conditionType="Parameter" useIsNull="False" field="peticiones.fecha" parameterSource="s_fecha_ini" dataType="Date" logicOperator="And" searchConditionType="GreaterThanOrEqual" parameterType="URL" orderNumber="3" leftBrackets="1"/>
				<TableParameter id="68" conditionType="Parameter" useIsNull="False" field="peticiones.fecha" dataType="Date" searchConditionType="LessThanOrEqual" parameterType="URL" logicOperator="And" parameterSource="s_fecha_fin" orderNumber="4" rightBrackets="1"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="122" tableName="peticiones" posWidth="141" posHeight="276" posLeft="10" posTop="10"/>
				<JoinTable id="126" tableName="previsiones" posWidth="109" posHeight="153" posLeft="206" posTop="147"/>
				<JoinTable id="128" tableName="procedencias" posWidth="100" posHeight="100" posLeft="179" posTop="8"/>
				<JoinTable id="130" tableName="pacientes" posWidth="169" posHeight="263" posLeft="340" posTop="0"/>
			</JoinTables>
			<JoinLinks>
				<JoinTable2 id="133" fieldLeft="peticiones.prevision_id" fieldRight="previsiones.prevision_id" tableLeft="peticiones" tableRight="previsiones" conditionType="Equal" joinType="left"/>
				<JoinTable2 id="134" fieldLeft="peticiones.procedencia_id" fieldRight="procedencias.procedencia_id" tableLeft="peticiones" tableRight="procedencias" conditionType="Equal" joinType="left"/>
				<JoinTable2 id="135" fieldLeft="peticiones.paciente_id" fieldRight="pacientes.paciente_id" tableLeft="peticiones" tableRight="pacientes" conditionType="Equal" joinType="left"/>
			</JoinLinks>
			<Fields>
				<Field id="123" tableName="peticiones" fieldName="peticion_id"/>
				<Field id="124" tableName="peticiones" alias="peticiones_prevision_id" fieldName="peticiones.prevision_id"/>
				<Field id="125" tableName="peticiones" fieldName="fecha"/>
				<Field id="127" tableName="previsiones" fieldName="nom_prevision"/>
				<Field id="129" tableName="procedencias" fieldName="nom_procedencia"/>
				<Field id="131" tableName="pacientes" fieldName="nombres"/>
				<Field id="132" tableName="pacientes" fieldName="apellidos"/>
			</Fields>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
			<PKFields/>
		</Grid>
		<Record id="73" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" debugMode="False" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="Impresion" wizardTheme="InLine" wizardThemeType="File" actionPage="stat_liquidacion" errorSummator="Error" wizardFormMethod="post" PathID="Impresion">
			<Components>
				<RadioButton id="84" fieldSourceType="DBColumn" sourceType="ListOfValues" dataType="Integer" html="True" editable="True" returnValueType="Number" name="s_detallado" wizardTheme="InLine" wizardThemeType="File" dataSource="0;Informe Detallado;1;Informe Resumido" required="True" caption="Tipo de Informe" visible="Yes" PathID="Impresions_detallado">
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
				</RadioButton>
				<Hidden id="74" fieldSourceType="DBColumn" dataType="Date" html="False" editable="True" hasErrorCollection="True" name="s_fecha_ini" wizardTheme="None" wizardThemeType="File" format="dd/mm/yyyy" DBFormat="yyyy-mm-dd HH:nn:ss" required="True" caption="Fecha Inicial" PathID="Impresions_fecha_ini">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="75" fieldSourceType="DBColumn" dataType="Date" html="False" editable="True" hasErrorCollection="True" name="s_fecha_fin" wizardTheme="None" wizardThemeType="File" required="True" format="dd/mm/yyyy" DBFormat="yyyy-mm-dd HH:nn:ss" caption="Fecha Final" PathID="Impresions_fecha_fin">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="81" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="s_procedencia_id" wizardTheme="InLine" wizardThemeType="File" caption="Procedencia" PathID="Impresions_procedencia_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="82" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="s_prevision_id" wizardTheme="InLine" wizardThemeType="File" caption="Procedencia" PathID="Impresions_prevision_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Button id="79" urlType="Relative" enableValidation="True" isDefault="False" name="Imprimir" wizardTheme="InLine" wizardThemeType="File" operation="Search" PathID="ImpresionImprimir">
					<Components/>
					<Events>
						<Event name="OnClick" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="83"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="80" urlType="Relative" enableValidation="False" isDefault="False" name="Cancelar" wizardTheme="InLine" wizardThemeType="File" operation="Cancel" returnPage="menu_principal.ccp" PathID="ImpresionCancelar">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
			</Components>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="153"/>
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
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="stat_liquidacion_events.php" comment="//" codePage="utf-8" forShow="False"/>
		<CodeFile id="Code" language="PHPTemplates" name="stat_liquidacion.php" comment="//" codePage="utf-8" forShow="True" url="stat_liquidacion.php"/>
	</CodeFiles>
	<SecurityGroups>
		<Group id="136" groupID="4"/>
		<Group id="137" groupID="5"/>
		<Group id="138" groupID="6"/>
		<Group id="139" groupID="7"/>
		<Group id="140" groupID="8"/>
		<Group id="141" groupID="13"/>
		<Group id="142" groupID="14"/>
		<Group id="143" groupID="15"/>
		<Group id="144" groupID="16"/>
		<Group id="145" groupID="17"/>
		<Group id="146" groupID="18"/>
		<Group id="147" groupID="19"/>
		<Group id="148" groupID="20"/>
	</SecurityGroups>
	<Events>
		<Event name="BeforeOutput" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="152"/>
			</Actions>
		</Event>
	</Events>
	<CachingParameters/>
	<Attributes/>
	<Features/>
</Page>

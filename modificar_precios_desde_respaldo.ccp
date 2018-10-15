<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" wizardTheme="InLine" wizardThemeType="File" needGeneration="0" accessDeniedPage="error_nivel.ccp" cachingEnabled="False" cachingDuration="1 minutes" isService="False">
	<Components>
		<Record id="25" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" debugMode="False" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="s_fecha" wizardCaption="Buscar Respaldos Precios Test, Test, Previsiones, Procedencias " wizardTheme="Inline" wizardThemeType="File" wizardOrientation="Vertical" wizardFormMethod="post" returnPage="modificar_precios_desde_respaldo.ccp" PathID="s_fecha">
			<Components>
				<ListBox id="48" fieldSourceType="DBColumn" sourceType="ListOfValues" dataType="Text" editable="True" hasErrorCollection="True" returnValueType="Number" name="s_fecha" wizardTheme="Inline" wizardThemeType="File" wizardEmptyCaption="Seleccionar Valor" _nameOfList="seleccionar fecha" dataSource=";seleccionar fecha" visible="Yes" PathID="s_fechas_fecha">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="49"/>
							</Actions>
						</Event>
					</Events>
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
				<ListBox id="29" fieldSourceType="DBColumn" sourceType="ListOfValues" dataType="Text" editable="True" hasErrorCollection="True" returnValueType="Number" name="respaldos_precios_test_tePageSize" dataSource=";Seleccionar Valor;5;5;10;10;25;25;100;100" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Registro por página" wizardNoEmptyValue="True" _valueOfList="{total}" _nameOfList="luca" visible="Yes" PathID="s_fecharespaldos_precios_test_tePageSize">
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
				<Button id="26" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Buscar" PathID="s_fechaButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="51" urlType="Relative" enableValidation="True" isDefault="False" name="bt_cambiaFecha" wizardTheme="Inline" wizardThemeType="File" PathID="s_fechabt_cambiaFecha">
					<Components/>
					<Events>
						<Event name="OnClick" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="52"/>
							</Actions>
						</Event>
					</Events>
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
		<Grid id="2" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="10" connection="Datos" dataSource="respaldos_precios_test, test, previsiones, procedencias" name="respaldos_precios_test_te" pageSizeLimit="100" wizardCaption="Lista de Respaldos Precios Test, Test, Previsiones, Procedencias " wizardTheme="Inline" wizardThemeType="File" wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAllowInsert="False" wizardAltRecord="True" wizardRecordSeparator="False" activeCollection="TableParameters" activeTableType="dataSource" orderBy="nom_test" PathID="respaldos_precios_test_te">
			<Components>
				<Label id="30" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="respaldos_precios_test_te_TotalRecords" wizardTheme="Inline" wizardThemeType="File" wizardUseTemplateBlock="False">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Retrieve number of records" actionCategory="Database" id="31"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Sorter id="36" visible="True" name="Sorter_nom_test" column="nom_test" wizardCaption="Nom Test" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="nom_test" PathID="respaldos_precios_test_teSorter_nom_test">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="33" visible="True" name="Sorter_nom_prevision" column="nom_prevision" wizardCaption="Nom Prevision" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="nom_prevision" PathID="respaldos_precios_test_teSorter_nom_prevision">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="34" visible="True" name="Sorter_nom_procedencia" column="nom_procedencia" wizardCaption="Nom Procedencia" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="nom_procedencia" PathID="respaldos_precios_test_teSorter_nom_procedencia">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="35" visible="True" name="Sorter_precio" column="precio" wizardCaption="Precio" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="precio" PathID="respaldos_precios_test_teSorter_precio">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Label id="40" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nom_test" fieldSource="nom_test" wizardCaption="Nom Test" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="37" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nom_prevision" fieldSource="nom_prevision" wizardCaption="Nom Prevision" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="38" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nom_procedencia" fieldSource="nom_procedencia" wizardCaption="Nom Procedencia" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="39" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="False" name="precio" fieldSource="precio" wizardCaption="Precio" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" format="$0##,###">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="44" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="Alt_nom_test" fieldSource="nom_test" wizardCaption="Nom Test" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="41" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="Alt_nom_prevision" fieldSource="nom_prevision" wizardCaption="Nom Prevision" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="42" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="Alt_nom_procedencia" fieldSource="nom_procedencia" wizardCaption="Nom Procedencia" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="43" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="False" name="Alt_precio" fieldSource="precio" wizardCaption="Precio" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" format="$0##,###">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="45" type="Centered" name="Navigator" size="10" wizardPagingType="Centered" wizardFirst="True" wizardFirstText="Inicio" wizardPrev="True" wizardPrevText="Anterior" wizardNext="True" wizardNextText="Siguiente" wizardLast="True" wizardLastText="Final" wizardImages="False" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="False" wizardOfText="de" wizardTheme="Inline" wizardThemeType="File" wizardImagesScheme="Inline" pageSizes="1;5;10;25;50" PathID="respaldos_precios_test_teNavigator">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
			</Components>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="50"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="32" conditionType="Parameter" useIsNull="False" field="fecha" parameterSource="s_fecha" dataType="Date" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1" DBFormat="yyyy-mm-dd HH:nn:ss" format="yyyy-mm-dd HH:nn:ss" defaultValue="'0000-00-00 00:00:00'"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="14" tableName="respaldos_precios_test" posWidth="203" posHeight="168" posLeft="505" posTop="146"/>
				<JoinTable id="16" tableName="test" posWidth="160" posHeight="336" posLeft="163" posTop="34"/>
				<JoinTable id="18" tableName="previsiones" posWidth="165" posHeight="124" posLeft="792" posTop="32"/>
				<JoinTable id="20" tableName="procedencias" posWidth="163" posHeight="145" posLeft="795" posTop="175"/>
			</JoinTables>
			<JoinLinks>
				<JoinTable2 id="22" fieldLeft="respaldos_precios_test.test_id" fieldRight="test.test_id" tableLeft="respaldos_precios_test" tableRight="test" conditionType="Equal" joinType="inner"/>
				<JoinTable2 id="23" fieldLeft="respaldos_precios_test.prevision_id" fieldRight="previsiones.prevision_id" tableLeft="respaldos_precios_test" tableRight="previsiones" conditionType="Equal" joinType="inner"/>
				<JoinTable2 id="24" fieldLeft="respaldos_precios_test.procedencia_id" fieldRight="procedencias.procedencia_id" tableLeft="respaldos_precios_test" tableRight="procedencias" conditionType="Equal" joinType="inner"/>
			</JoinLinks>
			<Fields>
				<Field id="15" tableName="respaldos_precios_test" fieldName="respaldos_precios_test.*"/>
				<Field id="17" tableName="test" fieldName="nom_test"/>
				<Field id="19" tableName="previsiones" fieldName="nom_prevision"/>
				<Field id="21" tableName="procedencias" fieldName="nom_procedencia"/>
			</Fields>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
			<PKFields/>
		</Grid>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="modificar_precios_desde_respaldo_events.php" comment="//" codePage="utf-8" forShow="False"/>
		<CodeFile id="Code" language="PHPTemplates" name="modificar_precios_desde_respaldo.php" comment="//" codePage="utf-8" forShow="True" url="modificar_precios_desde_respaldo.php"/>
	</CodeFiles>
	<SecurityGroups>
		<Group id="53" groupID="16"/>
		<Group id="54" groupID="17"/>
		<Group id="55" groupID="18"/>
		<Group id="56" groupID="19"/>
		<Group id="57" groupID="20"/>
	</SecurityGroups>
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

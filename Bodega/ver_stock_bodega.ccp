<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\Bodega" secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" needGeneration="0" wizardTheme="InLine" wizardThemeType="File" accessDeniedPage="error_nivel.ccp" cachingEnabled="False" cachingDuration="1 minutes" isService="False">
	<Components>
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" debugMode="False" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="insumosSearch" wizardCaption="Buscar Insumos " wizardTheme="Inline" wizardThemeType="File" wizardOrientation="Vertical" wizardFormMethod="post" returnPage="ver_stock_bodega.ccp" PathID="insumosSearch">
			<Components>
				<TextBox id="5" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="s_cod_insumo" wizardCaption="Cod Insumo" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" visible="Yes" PathID="insumosSearchs_cod_insumo">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="6" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="s_nom_insumo" wizardCaption="Nom Insumo" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" visible="Yes" PathID="insumosSearchs_nom_insumo">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="51" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" editable="True" hasErrorCollection="True" returnValueType="Number" name="s_test_id" wizardTheme="Inline" wizardThemeType="File" wizardEmptyCaption="Seleccionar Valor" connection="Datos" dataSource="test" boundColumn="test_id" textColumn="nom_test" visible="Yes" PathID="insumosSearchs_test_id">
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
				<ListBox id="7" fieldSourceType="DBColumn" sourceType="ListOfValues" dataType="Text" editable="True" hasErrorCollection="True" returnValueType="Number" name="insumosPageSize" dataSource=";Seleccionar Valor;5;5;10;10;25;25;100;100" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Registro por página" wizardNoEmptyValue="True" visible="Yes" PathID="insumosSearchinsumosPageSize">
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
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Buscar" PathID="insumosSearchButton_DoSearch">
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
		<Grid id="2" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="10" name="insumos" connection="Datos" dataSource="insumos, insumos_x_test" pageSizeLimit="100" wizardCaption="Lista de Insumos " wizardTheme="Inline" wizardThemeType="File" wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAllowInsert="False" wizardAltRecord="True" wizardRecordSeparator="False" orderBy="nom_insumo" activeCollection="TableParameters" activeTableType="dataSource" PathID="insumos">
			<Components>
				<Label id="8" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="insumos_TotalRecords" wizardTheme="Inline" wizardThemeType="File" wizardUseTemplateBlock="False">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Retrieve number of records" actionCategory="Database" id="9"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Sorter id="13" visible="True" name="Sorter_cod_insumo" column="cod_insumo" wizardCaption="Cod Insumo" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="cod_insumo" PathID="insumosSorter_cod_insumo">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="14" visible="True" name="Sorter_nom_insumo" column="nom_insumo" wizardCaption="Nom Insumo" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="nom_insumo" PathID="insumosSorter_nom_insumo">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="15" visible="True" name="Sorter_stock_min" column="stock_min" wizardCaption="Stock Min" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="stock_min" PathID="insumosSorter_stock_min">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="16" visible="True" name="Sorter_stock_max" column="stock_max" wizardCaption="Stock Max" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="stock_max" PathID="insumosSorter_stock_max">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Label id="36" fieldSourceType="DBColumn" dataType="Text" html="True" editable="False" name="estado" wizardTheme="Inline" wizardThemeType="File">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="38"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="18" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="cod_insumo" fieldSource="cod_insumo" wizardCaption="Cod Insumo" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="19" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nom_insumo" fieldSource="nom_insumo" wizardCaption="Nom Insumo" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="20" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="False" name="stock_min" fieldSource="stock_min" wizardCaption="Stock Min" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="21" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="False" name="stock_max" fieldSource="stock_max" wizardCaption="Stock Max" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="17" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="False" name="insumo_id" fieldSource="insumo_id" wizardCaption="Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" hasErrorCollection="True" PathID="insumosinsumo_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="28" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="False" name="total_ingreso" wizardTheme="Inline" wizardThemeType="File">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="31"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="29" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="False" name="total_salida" wizardTheme="Inline" wizardThemeType="File">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="30" fieldSourceType="DBColumn" dataType="Integer" html="True" editable="False" name="total_stock" wizardTheme="Inline" wizardThemeType="File">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="58" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="um" wizardTheme="Inline" wizardThemeType="File" fieldSource="unidad_medida">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="37" fieldSourceType="DBColumn" dataType="Text" html="True" editable="False" name="alt_estado" wizardTheme="Inline" wizardThemeType="File">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="39"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="23" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="Alt_cod_insumo" fieldSource="cod_insumo" wizardCaption="Cod Insumo" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="24" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="Alt_nom_insumo" fieldSource="nom_insumo" wizardCaption="Nom Insumo" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="25" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="False" name="Alt_stock_min" fieldSource="stock_min" wizardCaption="Stock Min" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="26" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="False" name="Alt_stock_max" fieldSource="stock_max" wizardCaption="Stock Max" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="22" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="False" name="Alt_insumo_id" fieldSource="insumo_id" wizardCaption="Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" hasErrorCollection="True" PathID="insumosAlt_insumo_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="32" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="False" name="alt_total_ingreso" wizardTheme="Inline" wizardThemeType="File">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="35"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="33" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="alt_total_salida" wizardTheme="Inline" wizardThemeType="File">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="34" fieldSourceType="DBColumn" dataType="Integer" html="True" editable="False" name="alt_total_stock" wizardTheme="Inline" wizardThemeType="File">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="59" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="alt_um" wizardTheme="Inline" wizardThemeType="File" fieldSource="unidad_medida">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="27" type="Centered" name="Navigator" size="10" wizardPagingType="Centered" wizardFirst="True" wizardFirstText="Inicio" wizardPrev="True" wizardPrevText="Anterior" wizardNext="True" wizardNextText="Siguiente" wizardLast="True" wizardLastText="Final" wizardImages="False" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="False" wizardOfText="de" wizardTheme="Inline" wizardThemeType="File" wizardImagesScheme="Inline" pageSizes="1;5;10;25;50" PathID="insumosNavigator">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="10" conditionType="Parameter" useIsNull="False" field="cod_insumo" parameterSource="s_cod_insumo" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="1"/>
				<TableParameter id="11" conditionType="Parameter" useIsNull="False" field="nom_insumo" parameterSource="s_nom_insumo" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="2"/>
				<TableParameter id="52" conditionType="Parameter" useIsNull="False" field="insumos_x_test.test_id" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="s_test_id" orderNumber="3"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="53" tableName="insumos" posWidth="186" posHeight="240" posLeft="427" posTop="106"/>
				<JoinTable id="55" tableName="insumos_x_test" posWidth="168" posHeight="153" posLeft="200" posTop="106"/>
			</JoinTables>
			<JoinLinks>
				<JoinTable2 id="57" fieldLeft="insumos_x_test.insumo_id" fieldRight="insumos.insumo_id" tableLeft="insumos_x_test" tableRight="insumos" conditionType="Equal" joinType="right"/>
			</JoinLinks>
			<Fields>
				<Field id="54" tableName="insumos" fieldName="insumos.*"/>
				<Field id="56" tableName="insumos_x_test" fieldName="test_id"/>
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
		<CodeFile id="Events" language="PHPTemplates" name="ver_stock_bodega_events.php" comment="//" codePage="utf-8" forShow="False"/>
		<CodeFile id="Code" language="PHPTemplates" name="ver_stock_bodega.php" comment="//" codePage="utf-8" forShow="True" url="ver_stock_bodega.php"/>
	</CodeFiles>
	<SecurityGroups>
		<Group id="60" groupID="16"/>
		<Group id="61" groupID="17"/>
		<Group id="62" groupID="18"/>
		<Group id="63" groupID="19"/>
		<Group id="64" groupID="20"/>
	</SecurityGroups>
	<Events>
		<Event name="BeforeOutput" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="65"/>
			</Actions>
		</Event>
	</Events>
	<CachingParameters/>
	<Attributes/>
	<Features/>
</Page>

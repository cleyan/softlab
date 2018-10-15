<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" wizardTheme="InLine" wizardThemeType="File" needGeneration="0" accessDeniedPage="error_nivel.ccp" cachingEnabled="False" cachingDuration="1 minutes" isService="False">
	<Components>
		<Record id="32" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" debugMode="False" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="precios_test_test_procedeSearch" wizardCaption="Buscar Precios Test, Test, Procedencias, Previsiones " wizardTheme="Inline" wizardThemeType="File" wizardOrientation="Vertical" wizardFormMethod="post" returnPage="list_precios.ccp" PathID="precios_test_test_procedeSearch">
			<Components>
				<ListBox id="34" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="s_precios_test_procedencia_id" wizardCaption="Precios Test Procedencia Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" sourceType="Table" connection="Datos" dataSource="procedencias" boundColumn="procedencia_id" textColumn="nom_procedencia" visible="Yes" PathID="precios_test_test_procedeSearchs_precios_test_procedencia_id">
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
				<ListBox id="35" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="s_precios_test_prevision_id" wizardCaption="Precios Test Prevision Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" sourceType="Table" connection="Datos" dataSource="previsiones" boundColumn="prevision_id" textColumn="nom_prevision" visible="Yes" PathID="precios_test_test_procedeSearchs_precios_test_prevision_id">
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
				<TextBox id="36" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="s_nom_test" wizardCaption="Nom Test" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" visible="Yes" PathID="precios_test_test_procedeSearchs_nom_test">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="37" fieldSourceType="DBColumn" sourceType="ListOfValues" dataType="Text" editable="True" hasErrorCollection="True" returnValueType="Number" name="precios_test_test_procedePageSize" dataSource=";Seleccionar Valor;5;5;10;10;25;25;100;100" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Registro por página" wizardNoEmptyValue="True" visible="Yes" PathID="precios_test_test_procedeSearchprecios_test_test_procedePageSize">
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
				<Button id="33" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Buscar" PathID="precios_test_test_procedeSearchButton_DoSearch">
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
		<Grid id="2" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="10" connection="Datos" dataSource="precios_test, test, procedencias, previsiones" name="precios_test_test_procede" pageSizeLimit="100" wizardCaption="Lista de Precios Test, Test, Procedencias, Previsiones " wizardTheme="Inline" wizardThemeType="File" wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAllowInsert="False" wizardAltRecord="True" wizardRecordSeparator="False" activeCollection="TableParameters" activeTableType="dataSource" PathID="precios_test_test_procede">
			<Components>
				<Label id="38" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="precios_test_test_procede_TotalRecords" wizardTheme="Inline" wizardThemeType="File" wizardUseTemplateBlock="False">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Retrieve number of records" actionCategory="Database" id="39"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Sorter id="43" visible="True" name="Sorter_codigo_fonasa" column="codigo_fonasa" wizardCaption="Codigo Fonasa" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="codigo_fonasa" PathID="precios_test_test_procedeSorter_codigo_fonasa">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="44" visible="True" name="Sorter_nom_test" column="nom_test" wizardCaption="Nom Test" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="nom_test" PathID="precios_test_test_procedeSorter_nom_test">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="45" visible="True" name="Sorter_precio" column="precio" wizardCaption="Precio" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="precio" PathID="precios_test_test_procedeSorter_precio">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="46" visible="True" name="Sorter_nom_prevision" column="nom_prevision" wizardCaption="Nom Prevision" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="nom_prevision" PathID="precios_test_test_procedeSorter_nom_prevision">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="47" visible="True" name="Sorter_nom_procedencia" column="nom_procedencia" wizardCaption="Nom Procedencia" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="nom_procedencia" PathID="precios_test_test_procedeSorter_nom_procedencia">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Label id="48" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="codigo_fonasa" fieldSource="codigo_fonasa" wizardCaption="Codigo Fonasa" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="49" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nom_test" fieldSource="nom_test" wizardCaption="Nom Test" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="50" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="False" name="precio" fieldSource="precio" wizardCaption="Precio" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="51" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nom_prevision" fieldSource="nom_prevision" wizardCaption="Nom Prevision" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="52" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nom_procedencia" fieldSource="nom_procedencia" wizardCaption="Nom Procedencia" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="53" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="Alt_codigo_fonasa" fieldSource="codigo_fonasa" wizardCaption="Codigo Fonasa" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="54" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="Alt_nom_test" fieldSource="nom_test" wizardCaption="Nom Test" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="55" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="False" name="Alt_precio" fieldSource="precio" wizardCaption="Precio" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="56" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="Alt_nom_prevision" fieldSource="nom_prevision" wizardCaption="Nom Prevision" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="57" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="Alt_nom_procedencia" fieldSource="nom_procedencia" wizardCaption="Nom Procedencia" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="58" type="Centered" name="Navigator" size="10" wizardPagingType="Centered" wizardFirst="True" wizardFirstText="Inicio" wizardPrev="True" wizardPrevText="Anterior" wizardNext="True" wizardNextText="Siguiente" wizardLast="True" wizardLastText="Final" wizardImages="False" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="False" wizardOfText="de" wizardTheme="Inline" wizardThemeType="File" wizardImagesScheme="Inline" pageSizes="1;5;10;25;50" PathID="precios_test_test_procedeNavigator">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="40" conditionType="Parameter" useIsNull="False" field="precios_test.procedencia_id" parameterSource="s_precios_test_procedencia_id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1"/>
				<TableParameter id="41" conditionType="Parameter" useIsNull="False" field="precios_test.prevision_id" parameterSource="s_precios_test_prevision_id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="2"/>
				<TableParameter id="42" conditionType="Parameter" useIsNull="False" field="nom_test" parameterSource="s_nom_test" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="3"/>
				<TableParameter id="59" conditionType="Parameter" useIsNull="False" field="test.aislado" dataType="Text" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="'V'" orderNumber="4"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="17" tableName="precios_test" posWidth="272" posHeight="376" posLeft="10" posTop="10"/>
				<JoinTable id="22" tableName="test" posWidth="243" posHeight="517" posLeft="501" posTop="56"/>
				<JoinTable id="25" tableName="procedencias" posWidth="100" posHeight="100" posLeft="363" posTop="200"/>
				<JoinTable id="27" tableName="previsiones" posWidth="100" posHeight="100" posLeft="352" posTop="363"/>
			</JoinTables>
			<JoinLinks>
				<JoinTable2 id="29" fieldLeft="precios_test.test_id" fieldRight="test.test_id" tableLeft="precios_test" tableRight="test" conditionType="Equal" joinType="left"/>
				<JoinTable2 id="30" fieldLeft="precios_test.procedencia_id" fieldRight="procedencias.procedencia_id" tableLeft="precios_test" tableRight="procedencias" conditionType="Equal" joinType="left"/>
				<JoinTable2 id="31" fieldLeft="precios_test.prevision_id" fieldRight="previsiones.prevision_id" tableLeft="precios_test" tableRight="previsiones" conditionType="Equal" joinType="left"/>
			</JoinLinks>
			<Fields>
				<Field id="18" tableName="precios_test" alias="precios_test_procedencia_id" fieldName="precios_test.procedencia_id"/>
				<Field id="19" tableName="precios_test" alias="precios_test_test_id" fieldName="precios_test.test_id"/>
				<Field id="20" tableName="precios_test" alias="precios_test_prevision_id" fieldName="precios_test.prevision_id"/>

				<Field id="21" tableName="precios_test" fieldName="precio"/>
				<Field id="23" tableName="test" fieldName="codigo_fonasa"/>
				<Field id="24" tableName="test" fieldName="nom_test"/>
				<Field id="26" tableName="procedencias" fieldName="nom_procedencia"/>
				<Field id="28" tableName="previsiones" fieldName="nom_prevision"/>
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
		<CodeFile id="Events" language="PHPTemplates" name="list_precios_events.php" comment="//" codePage="utf-8" forShow="False"/>
		<CodeFile id="Code" language="PHPTemplates" name="list_precios.php" comment="//" codePage="utf-8" forShow="True" url="list_precios.php"/>
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

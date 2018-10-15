<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\Bodega" secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" wizardTheme="InLine" wizardThemeType="File" needGeneration="0" accessDeniedPage="error_nivel.ccp" cachingEnabled="False" cachingDuration="1 minutes" isService="False">
	<Components>
		<Record id="51" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" debugMode="False" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="insumos_ingreso_insumosSearch" wizardCaption="Buscar Insumos Ingreso, Insumos " wizardTheme="Inline" wizardThemeType="File" wizardOrientation="Vertical" wizardFormMethod="post" returnPage="list_ingreso_insumos.ccp" PathID="insumos_ingreso_insumosSearch">
			<Components>
				<TextBox id="53" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="s_insumo" wizardCaption="Cod Insumo" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" visible="Yes" PathID="insumos_ingreso_insumosSearchs_insumo">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="55" fieldSourceType="DBColumn" dataType="Date" html="False" editable="True" hasErrorCollection="True" name="s_fecha" wizardCaption="Fecha" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" visible="Yes" PathID="insumos_ingreso_insumosSearchs_fecha">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Button id="52" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Buscar" PathID="insumos_ingreso_insumosSearchButton_DoSearch">
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
		<Grid id="32" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="10" connection="Datos" dataSource="insumos_ingreso, insumos" name="insumos_ingreso_insumos" pageSizeLimit="100" wizardCaption="Lista de Insumos Ingreso, Insumos " wizardTheme="Inline" wizardThemeType="File" wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAllowInsert="False" wizardAltRecord="True" wizardRecordSeparator="False" activeCollection="TableParameters" activeTableType="dataSource" orderBy="fecha desc" PathID="insumos_ingreso_insumos">
			<Components>
				<Label id="57" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="insumos_ingreso_insumos_TotalRecords" wizardTheme="Inline" wizardThemeType="File" wizardUseTemplateBlock="False">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Retrieve number of records" actionCategory="Database" id="58"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Sorter id="65" visible="True" name="Sorter_fecha" column="fecha" wizardCaption="Fecha" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="fecha" PathID="insumos_ingreso_insumosSorter_fecha">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="62" visible="True" name="Sorter_cod_insumo" column="cod_insumo" wizardCaption="Cod Insumo" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="cod_insumo" PathID="insumos_ingreso_insumosSorter_cod_insumo">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="63" visible="True" name="Sorter_nom_insumo" column="nom_insumo" wizardCaption="Nom Insumo" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="nom_insumo" PathID="insumos_ingreso_insumosSorter_nom_insumo">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="64" visible="True" name="Sorter_cantidad" column="cantidad" wizardCaption="Cantidad" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="cantidad" PathID="insumos_ingreso_insumosSorter_cantidad">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="66" visible="True" name="Sorter_costo" column="costo" wizardCaption="Costo" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="costo" PathID="insumos_ingreso_insumosSorter_costo">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Link id="78" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" editable="False" name="Link1" wizardTheme="Inline" wizardThemeType="File" hrefSource="ingreso_insumo.ccp" visible="Yes" PathID="insumos_ingreso_insumosLink1">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="80" sourceType="DataField" name="ingreso_insumo_id" source="ingreso_insumo_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="70" fieldSourceType="DBColumn" dataType="Date" html="False" editable="False" name="fecha" fieldSource="fecha" wizardCaption="Fecha" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" format="dd/mm/yyyy" DBFormat="yyyy-mm-dd HH:nn:ss">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="67" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="cod_insumo" fieldSource="cod_insumo" wizardCaption="Cod Insumo" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="68" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nom_insumo" fieldSource="nom_insumo" wizardCaption="Nom Insumo" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="69" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="False" name="cantidad" fieldSource="cantidad" wizardCaption="Cantidad" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="71" fieldSourceType="DBColumn" dataType="Float" html="False" editable="False" name="costo" fieldSource="costo" wizardCaption="Costo" wizardTheme="Inline" wizardThemeType="File" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" format="$0##,###">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Link id="79" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" editable="False" name="Link2" wizardTheme="Inline" wizardThemeType="File" hrefSource="ingreso_insumo.ccp" visible="Yes" PathID="insumos_ingreso_insumosLink2">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="81" sourceType="DataField" name="ingreso_insumo_id" source="ingreso_insumo_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="75" fieldSourceType="DBColumn" dataType="Date" html="False" editable="False" name="Alt_fecha" fieldSource="fecha" wizardCaption="Fecha" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" format="dd/mm/yyyy" DBFormat="yyyy-mm-dd HH:nn:ss">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="72" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="Alt_cod_insumo" fieldSource="cod_insumo" wizardCaption="Cod Insumo" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="73" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="Alt_nom_insumo" fieldSource="nom_insumo" wizardCaption="Nom Insumo" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="74" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="False" name="Alt_cantidad" fieldSource="cantidad" wizardCaption="Cantidad" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="76" fieldSourceType="DBColumn" dataType="Float" html="False" editable="False" name="Alt_costo" fieldSource="costo" wizardCaption="Costo" wizardTheme="Inline" wizardThemeType="File" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" format="$0##,###">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="77" type="Centered" name="Navigator" size="10" wizardPagingType="Centered" wizardFirst="True" wizardFirstText="Inicio" wizardPrev="True" wizardPrevText="Anterior" wizardNext="True" wizardNextText="Siguiente" wizardLast="True" wizardLastText="Final" wizardImages="False" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="False" wizardOfText="de" wizardTheme="Inline" wizardThemeType="File" wizardImagesScheme="Inline" pageSizes="1;5;10;25;50" PathID="insumos_ingreso_insumosNavigator">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="59" conditionType="Parameter" useIsNull="False" field="cod_insumo" parameterSource="s_insumo" dataType="Text" logicOperator="Or" searchConditionType="Contains" parameterType="URL" orderNumber="1" leftBrackets="1"/>
				<TableParameter id="60" conditionType="Parameter" useIsNull="False" field="nom_insumo" parameterSource="s_insumo" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="2" rightBrackets="1"/>
				<TableParameter id="61" conditionType="Parameter" useIsNull="False" field="fecha" parameterSource="s_fecha" dataType="Date" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="3" DBFormat="yyyy-mm-dd HH:nn:ss" format="dd/mm/yyyy"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="41" tableName="insumos_ingreso" posWidth="161" posHeight="232" posLeft="10" posTop="10"/>
				<JoinTable id="47" tableName="insumos" posWidth="133" posHeight="150" posLeft="206" posTop="10"/>
			</JoinTables>
			<JoinLinks>
				<JoinTable2 id="50" fieldLeft="insumos_ingreso.insumo_id" fieldRight="insumos.insumo_id" tableLeft="insumos_ingreso" tableRight="insumos" conditionType="Equal" joinType="inner"/>
			</JoinLinks>
			<Fields>
				<Field id="42" tableName="insumos_ingreso" fieldName="ingreso_insumo_id"/>
				<Field id="43" tableName="insumos_ingreso" alias="insumo_id" fieldName="insumos_ingreso.insumo_id"/>
				<Field id="44" tableName="insumos_ingreso" fieldName="cantidad"/>
				<Field id="45" tableName="insumos_ingreso" fieldName="fecha"/>
				<Field id="46" tableName="insumos_ingreso" fieldName="costo"/>
				<Field id="48" tableName="insumos" fieldName="cod_insumo"/>
				<Field id="49" tableName="insumos" fieldName="nom_insumo"/>
			</Fields>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
			<PKFields/>
		</Grid>
		<ImageLink id="82" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" editable="False" name="ImageLink1" wizardTheme="InLine" wizardThemeType="File" hrefSource="ingreso_insumo.ccp" visible="Yes" PathID="ImageLink1">
			<Components/>
			<Events/>
			<LinkParameters/>
			<Attributes/>
			<Features/>
		</ImageLink>
		<IncludePage id="88" hasOperation="True" name="calendar_tag" wizardTheme="InLine" wizardThemeType="File" page="calendar_tag.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="list_ingreso_insumos_events.php" comment="//" codePage="utf-8" forShow="False"/>
		<CodeFile id="Code" language="PHPTemplates" name="list_ingreso_insumos.php" comment="//" codePage="utf-8" forShow="True" url="list_ingreso_insumos.php"/>
	</CodeFiles>
	<SecurityGroups>
		<Group id="83" groupID="16"/>
		<Group id="84" groupID="17"/>
		<Group id="85" groupID="18"/>
		<Group id="86" groupID="19"/>
		<Group id="87" groupID="20"/>
	</SecurityGroups>
	<Events>
		<Event name="BeforeOutput" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="89"/>
			</Actions>
		</Event>
	</Events>
	<CachingParameters/>
	<Attributes/>
	<Features/>
</Page>
